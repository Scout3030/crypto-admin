<?php

namespace App\Helpers\Services;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Segment;
use Throwable;

class SegmentService
{
    protected ?Request $request;
    private ?User $user;
    private ?string $userId = null;

    public function init(?User $user = null): self
    {
        if ($user instanceof User) {
            $this->initUser($user);
        } else {
            $this->initAnonymous();
        }

        $this->request = request();

        return $this;
    }

    /**
     * @param string $eventName
     * @param array  $properties
     *
     * @throws \Exception
     */
    public function event(string $eventName, array $properties = []): void
    {
        if ($this->userId) {
            $addData = $this->getProperties($properties);
            Segment::track([
                'userId'     => $this->userId,
                'event'      => $eventName,
                'properties' => $addData,
            ]);
        } else {
            throw new Exception('Set user Id for segment track');
        }
    }

    private function initUser(User $user): void
    {
        $this->user = $user;
        $this->userId = $user->id;
    }

    private function initAnonymous(): void
    {
        $this->user = null;
        $this->userId = session()->getId();
    }

    /**
     * @param \App\Models\User|null $user
     *
     * @return $this
     * @throws \Exception
     */
    public function identify(?User $user = null): self
    {
        if ($user) {
            $this->init($user);
        }

        if ($this->userId) {
            $data = $this->getIdentificationData();
            Segment::identify($data);

            return $this;
        }

        throw new Exception('Set user Id for segment track');
    }

    private function getIdentificationData(): array
    {
        if ($this->user) {
            return [
                'userId' => $this->user->id,
                'traits' => $this->getUserData(),
            ];
        }

        return [
            'userId' => $this->userId,
            'traits' => [
                'ip' => $this->request->ip(),
            ],
        ];
    }

    private function getUserData(): array
    {
        if ($this->user) {
            return [
                'email'      => $this->user->email,
                'first_name' => $this->user->first_name,
                'last_name'  => $this->user->last_name,
                'ip'         => $this->request->ip(),
                'datetime'   => now(),
                'agent'      => $this->request->server->all()['HTTP_USER_AGENT'] ?? 'n/a',
            ];
        }

        return [];
    }

    private function getProperties(array $properties): array
    {
        $user = [
            'user_details' => $this->getUserData(),
        ];

        return array_merge($user, $properties);
    }
}
