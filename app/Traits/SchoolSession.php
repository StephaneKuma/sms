<?php

namespace App\Traits;

trait SchoolSession
{
    /**
     * Get the current/ongoing school session id
     *
     * @return int
     */
    public function getCurrentSchoolSession(): int
    {
        $currentSchoolSessionId = 0;

        if (session()->has('browse_session_id')) {
            $currentSchoolSessionId = session('browse_session_id');
        } else {
            $latestSchoolSession = $this->sessionService->getLatest();

            if ($latestSchoolSession) {
                $currentSchoolSessionId = $latestSchoolSession->id;
            }
        }

        return $currentSchoolSessionId;
    }
}
