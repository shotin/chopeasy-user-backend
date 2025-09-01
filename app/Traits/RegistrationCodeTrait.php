<?php

namespace App\Traits;

use App\Enums\IdentifierTypeEnums;
use App\Enums\VerificationCodeStatusEnums;
use App\Exceptions\BadRequestException;
use App\Helpers\GeneralHelper;
use App\Mail\Member\CreatePasswordMail;
use App\Mail\Member\MemberVerifyMail;
use App\Mail\Relative\RelativeVerifyMail;
use App\Models\User;
use App\Services\Sms\VansoSMS;
use App\Services\UserVerification\UserVerificationService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

trait RegistrationCodeTrait
{
    protected UserVerificationService $userVerificationService;

    public function __construct(
        UserVerificationService $userVerificationService,
    ) {
        $this->userVerificationService = $userVerificationService;
    }

    public function generateRegistrationCode(
          User $user,
          string $modelable_type,
          int $modelable_id,
          ?bool $resend = false,
          ?string $identifier_type = IdentifierTypeEnums::EMAIL->value,
          User $icobaAlumni = null, //if relative registation, add main icoba alumni
          ?string $relationship = null,
      )
      {

        if ($resend) {
            $this->resendRegistrationCode($user->id, $modelable_type, $modelable_id);
        }

        $currentTime = date('Y-m-d H:i:s');
        $expiresAt = strtotime("+10 minutes", strtotime($currentTime));
        $expireFormatted = date('Y-m-d H:i:s', $expiresAt);

        $token = GeneralHelper::getModelUniqueRandomId([
          'modelNamespace' => 'App\Models\UserVerification',
          'modelField' => 'code',
          "idLength" => 30,
          "idType" => "numalpha",
        ]);

       $record = $this->userVerificationService->create([
          'identifier' => $identifier_type == IdentifierTypeEnums::EMAIL->value ? $user->email : $user->phoneno,
          'identifier_type' => $identifier_type,
          'code' => $token,
          'expires_at' => $expireFormatted,
          'user_id' => $user->id,
          'modelable_type' => $modelable_type,
          'modelable_id' => $modelable_id
        ]);

        $emailData = [
          'user' => $user,
          'verificationUrl' => $token,
          'icobaAlumni' => $icobaAlumni,
          'relationship' => $relationship,
        ];

        if($icobaAlumni){
          Mail::to($user->email)->send(new CreatePasswordMail($emailData));
        }else{
          Mail::to($user->email)->send(new CreatePasswordMail($emailData));
        }

        $dataToLog = [
          'causer_id' => $user->id,
          'action_id' => $record['id'],
          'action_type' => "App\Models\UserVerification",
          'log_name' => "Member verification code generated successfully",
          'description' => "{$user['firstname']} {$user['lastname']} generated a verification code",
        ];

        GeneralHelper::storeAuditLog($dataToLog);
    }

    protected function resendRegistrationCode($userId, $modelableType, $modelableId)
    {
        $verification = $this->userVerificationService->findByMultiAttributes(
            [
            'user_id' => $userId,
            'modelable_id' => $modelableId,
            'modelable_type' => $modelableType
      ]
        );

        if (!$verification) {
            throw new BadRequestException("User not found");
        }

        if ($verification['status'] == VerificationCodeStatusEnums::PENDING->value) {
            $verification->update([
              'status' => VerificationCodeStatusEnums::RESENT->value,
            ]);
        }
    }
}
