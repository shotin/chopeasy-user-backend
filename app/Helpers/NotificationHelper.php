<?php

namespace App\Helpers;

use App\Helpers\EncryptionHelper;
use App\Models\Set;
use App\Models\User;
use App\Models\UserNotification;
use App\Services\User\UserService;

class NotificationHelper
{

    protected $setService;
    protected $userService;

    public function __construct(
        UserService $userService,
    ) {
        $this->userService = $userService;
    }


    public static function sendSetNotification($setId = null, $userId = null, $type, $message, $modelableType = null, $modelableId = null, $triggerUserID = null, $extraData = [])
    {
        if ($setId) {
            // Fetch users associated with the set based on $setId
            $set = Set::find($setId);
            // $set = $this->setService->find($setId);

            if ($set) {
                $usersInSet = $set->users; // Retrieve all users in the set
                foreach ($usersInSet as $user) {
                    self::createNotification($user->id, $type, $message, $modelableType, $modelableId, $triggerUserID, $setId, $extraData);
                }
            }
        } elseif ($userId) {
            self::createNotification($userId, $type, $message, $modelableType, $modelableId);
        }
    }

    public static function createNotificationForFollowersAndFollowing($userId, $type, $message, $modelableType = null, $modelableId = null, $triggerUserID = null, $extraData = [])
    {
        // Get the user
        $user = User::find($userId);

        // Notify followers if any
        if ($user->followers->isNotEmpty()) {
            foreach ($user->followers as $follower) {
                self::createNotification(
                    $follower->id,
                    $type,
                    $message,
                    $modelableType,
                    $modelableId,
                    $triggerUserID,
                    $follower->set_id,
                    $extraData
                );
            }
        }

        // Notify following if any
        if ($user->following->isNotEmpty()) {
            foreach ($user->following as $following) {
                self::createNotification(
                    $following->id,
                    $type,
                    $message,
                    $modelableType,
                    $modelableId,
                    $triggerUserID,
                    $following->set_id,
                    $extraData
                );
            }
        }
    }

    public static function createNotificationForSingleUser($userId, $type, $message, $modelableType = null, $modelableId = null, $triggerUserID = null, $extraData = [])
    {
        // Get the user
        $user = User::find($userId);

        // Notify user
        self::createNotification($user->id, $type, $message, $modelableType, $modelableId, $triggerUserID, $user->set_id, $extraData);
    }

    public static function createNotificationForSelectedUsers($selectedUserIds, $type, $message, $modelableType = null, $modelableId = null, $triggerUserID = null, $extraData = [])
    {
        // Ensure $selectedUserIds is an array
        if (is_array($selectedUserIds)) {
            foreach ($selectedUserIds as $userId) {
                // Get the user
                $user = User::find($userId);

                self::createNotification($userId, $type, $message, $modelableType, $modelableId, $triggerUserID, $user->set_id, $extraData);
            }
        } else {
            // Optionally handle cases where the input is not an array (if necessary)
            throw new \Exception("Selected user IDs must be an array");
        }
    }

    private static function createNotification($userId, $type, $message, $modelableType = null, $modelableId = null, $triggerUserID = null, $setID = null, $extraData = [])
    {
        // Create a new notification record first to get the created_at timestamp
        $notification = UserNotification::create([
            'user_id' => $userId,
            'set_id' => $setID,
            'type' => $type,
            'message' => $message,
            'modelable_type' => null, // Temporarily null
            'modelable_id' => $modelableId,
            'trigger_id' => $triggerUserID,
            'extra_data' => json_encode($extraData),
        ]);

        // Use the created_at timestamp for encryption
        $createdAt = $notification->created_at;

        // Encrypt modelable_type and modelable_id using created_at
        $encryptedModelableType = $modelableType ? EncryptionHelper::encryptWithKey($modelableType . '|' . $createdAt) : null;
        $encryptedModelableId = $modelableId ? EncryptionHelper::encryptWithKey($modelableId . '|' . $createdAt) : null;

        // Update the record with the encrypted data
        $notification->update([
            'modelable_type' => $encryptedModelableType,
            // 'modelable_id' => $encryptedModelableId,
        ]);
    }
}
