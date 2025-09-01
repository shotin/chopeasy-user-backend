<?php

namespace App\Helpers;

use App\Models\AuditLog;
use App\Models\AuditLogTransaction;
use App\Models\User;
use App\Traits\VerificationCodeTrait;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


class GeneralHelper
{
    use VerificationCodeTrait;

    // Here we have all the general Helpers needed for this application

    //Store Audit Log
    public static function storeAuditLog($dataToLog)
    {
        if (!is_null($dataToLog)) {
            $auditLog = AuditLog::create([
                'causer_id' => $dataToLog['causer_id'],
                'action_type' => $dataToLog['action_type'],
                'action_id' => $dataToLog['action_id'],
                'action' => isset($dataToLog['action']) ? $dataToLog['action'] : 'Update',
                'log_name' => $dataToLog['log_name'],
                'description' => $dataToLog['description']
            ]);

            $auditLogTransaction = AuditLogTransaction::create([
                'audit_log_id' => $auditLog->id,
                'old_data' => isset($dataToLog['old_data']) ? json_encode($dataToLog['old_data']) : json_encode([]),
                'new_data' => isset($dataToLog['new_data']) ? json_encode($dataToLog['new_data']) : json_encode([]),
            ]);
        }
    }

    public static function getModelUniqueOrderlyId($data)
    {
        $modelClass = $data['modelNamespace'];
        $modelField = $data['modelField'];
        $prefix = $data['prefix'] ?? "";
        $suffix = $data['suffix'] ?? "";
        $idLength = $data['idLength'] ?? 6;

        if (!class_exists($modelClass)) {
            return ['error' => true, 'message' => 'Model class not found'];
        }

        $record = $modelClass::latest()->first();
        $fieldId = $record->{$modelField} ?? '';
        if (!$fieldId) {
            return $prefix . str_pad(1, $idLength, '0', STR_PAD_LEFT) . $suffix;
        }

        $escapedPrefix = preg_quote($prefix, '/');
        $escapedSuffix = preg_quote($suffix, '/');
        $pattern = "/^{$escapedPrefix}(.*?){$escapedSuffix}$/";

        $currentId = preg_replace($pattern, '$1', $fieldId);
        $idLength = strlen($currentId);
        $incrementedId = intval($currentId) + 1;

        return $prefix . str_pad($incrementedId, $idLength, '0', STR_PAD_LEFT) . $suffix;
    }

    public static function getModelUniqueRandomId($data)
    {
        $modelClass = $data['modelNamespace'];
        $modelField = $data['modelField'];


        if (!class_exists($modelClass)) {
            return ['error' => true, 'message' => 'Model class not found'];
        }

        $uniqueId = self::generateUniqueRandomId($data);
        $record = $modelClass::where($modelField, $uniqueId)->first();

        if ($record) {
            return self::getModelUniqueRandomId($data);
        }

        return $uniqueId;
    }

    public static function generateUniqueRandomId($data)
    {
        $prefix = $data['prefix'] ?? "";
        $suffix = $data['suffix'] ?? "";
        $idLength = $data['idLength'] ?? 5;
        $idType = $data['idType'] ?? 'num'; //num, numalpha

        if ($idType == 'num') {
            $uniqueId = rand(0, pow(10, $idLength) - 1);
        } elseif ($idType == 'numalpha') {
            $uniqueId = strtoupper(str_random($idLength));
        } else {
            $uniqueId = str_random($idLength);
        }

        return $prefix . str_pad($uniqueId, $idLength, '0', STR_PAD_LEFT) . $suffix;
    }

    public static function dateFilter(?string $period, array $customDate): array|bool
    {
        if ($period === "3 days") {
            $carbonDateFilter = [Carbon::now()->subDays(3)->startOfDay(), Carbon::now()->endOfDay()];
        } elseif ($period == "7 days") {
            $carbonDateFilter = [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()];
        } elseif ($period == "14 days") {
            $carbonDateFilter = [Carbon::now()->subWeeks(2)->startOfDay(), Carbon::now()->endOfDay()];
        } elseif ($period == "30 days") {
            $carbonDateFilter = [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()];
        } elseif ($period == "custom date") {
            $carbonDateFilter = [Carbon::parse($customDate[0]), Carbon::parse($customDate[1])];
        } else {
            $carbonDateFilter = false;
        }

        return $carbonDateFilter;
    }

    public static function generateUniqueMembershipID($entryYear)
    {
        $startFrom = User::where('membershipID', 'LIKE', "ICOBA0I{$entryYear}-%")
            ->count() + 1; // Start from the next available sequence number

        do {
            // Dynamically generate the sequence
            $sequence = str_pad($startFrom, 6, '0', STR_PAD_LEFT);
            $membershipID = "ICOBA0I{$entryYear}-{$sequence}";

            $startFrom++; // Increment the sequence to try the next number if this one exists
        } while (User::where('membershipID', $membershipID)->exists());

        return $membershipID;
    }

    public function sendNewUserApprovalMail($requestorId)
    {
        $requestor = User::where('id', $requestorId)->first();
        $this->generateNewUserVerificationCode($requestor, 'App\Models\User', $requestor['id']);
    }

    public static function maskEmail(string $email): string
    {
        [$name, $domain] = explode('@', $email);
        if (strlen($name) <= 2) {
            return str_repeat('*', strlen($name)) . "@{$domain}";
        }
        return substr($name, 0, 1) . str_repeat('*', strlen($name) - 2) . substr($name, -1) . "@{$domain}";
    }

    public static function maskPhone(string $phoneNumber, string $countryCode = '+234'): string
    {
        // Remove any non-numeric characters (except the leading '+')
        $cleanedNumber = preg_replace('/[^0-9+]/', '', $phoneNumber);

        // If it starts with the country code, mask digits after it
        if (str_starts_with($cleanedNumber, $countryCode)) {
            $digitsToMask = strlen($cleanedNumber) - strlen($countryCode) - 2;
            if ($digitsToMask > 0) {
                return $countryCode . Str::mask(substr($cleanedNumber, strlen($countryCode)), '*', 0, $digitsToMask);
            } else {
                return $countryCode . substr($cleanedNumber, strlen($countryCode)); // Not enough digits to mask
            }
        } else {
            // If it doesn't start with the country code, mask digits from the beginning
            $digitsToMask = strlen($cleanedNumber) - 2;
            if ($digitsToMask > 0) {
                return Str::mask($cleanedNumber, '*', 0, $digitsToMask);
            } else {
                return $cleanedNumber; // Not enough digits to mask
            }
        }
    }


    /**
     * Get the count of records whether paginated or not
     *
     * @param LengthAwarePaginator|Collection|array $records
     * @return int
     */
    public static function getCount($records): int
    {
        return $records instanceof LengthAwarePaginator
            ? $records->total()
            : (is_countable($records) ? count($records) : 0);
    }
}
