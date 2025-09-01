<?php

namespace App\Traits;

use App\Enums\IdentifierTypeEnums;
use App\Enums\VerificationCodeStatusEnums;
use App\Exceptions\BadRequestException;
use App\Helpers\GeneralHelper;
use App\Mail\Member\MemberOTPMail;
use App\Mail\Relative\MemberVerifyMail;
use App\Services\Sms\InfobipSMS;
use App\Services\Sms\VansoSMS;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

trait VerificationCodeTraitOld
{

  public function generateVerificationCode($user, string $modelable_type, int $modelable_id, ?string $identifier_type = IdentifierTypeEnums::PHONENUMBER->value)
  {
    //TODO: pending sms provider

    $currentTime = date('Y-m-d H:i:s');
    $expiresAt = strtotime("+5 minutes", strtotime($currentTime));
    $expireFormatted = date('Y-m-d H:i:s', $expiresAt);

    $otp = GeneralHelper::getModelUniqueRandomId([
      'modelNamespace' => 'App\Models\UserVerification',
      'modelField' => 'code',
      "idLength" => 6,
    ]);


    

    $record = $this->userVerificationService->create([
      'identifier' => $identifier_type = IdentifierTypeEnums::PHONENUMBER->value ? $user->phoneno : $user->email,
      'identifier_type' => $identifier_type,
      'code' => $otp,
      'expires_at' => $expireFormatted,
      'user_id' => $user->id,
      'modelable_type' => $modelable_type,
      'modelable_id' => $modelable_id
    ]);

    $data = [
      'phonenumber' => '+234' . $user->phoneno,
      'message' => "Your one-time password (OTP) verification code is: " . $otp,
    ];

    if($identifier_type ===  IdentifierTypeEnums::PHONENUMBER->value){
      // VansoSMS::sendOTP($data);
    }

    if($identifier_type === IdentifierTypeEnums::EMAIL->value){
      Mail::to($data['email'])->send(new MemberOTPMail($data));
    }

    $dataToLog = [
      'causer_id' => $user->id,
      'action_id' => $record->id,
      'action_type' => "App\Models\UserVerification",
      'log_name' => "User verification code generated successfully",
      'description' => "{$user['firstname']} {$user['lastname']} generated a verification code",
    ];

    GeneralHelper::storeAuditLog($dataToLog);
  }

  public function confirmVerificationCode(string $modelable_type, int $modelable_id, string $code)
  {
    $currentUser = auth()->user();
    $verification = $this->userVerificationService->findByMultiAttributes(
      [
        'code' => $code,
        'modelable_id' => $modelable_id,
        'modelable_type' => $modelable_type
      ]
    );

    if (!$verification) {
      throw new BadRequestException("Invalid code");
    }

    if (Carbon::parse($verification['expires_at']) < now()) {
      $verification->update([
        'status' => VerificationCodeStatusEnums::EXPIRED->value,
      ]);
      throw new BadRequestException("Code expired");
    }

    $verification->update([
      'verified_at' => now(),
      'status' => VerificationCodeStatusEnums::VERIFIED->value,
    ]);

    if ($currentUser) {
      $dataToLog = [
        'causer_id' => $currentUser->id,
        'action_id' => $verification->id,
        'action_type' => "App\Models\UserVerification",
        'log_name' => "Member verification code generated successfully",
        'description' => "{$currentUser['firstname']} {$currentUser['lastname']} verification code confirmed successfully",
      ];

      GeneralHelper::storeAuditLog($dataToLog);
    }
  }
}
