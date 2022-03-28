<?php

namespace App\Repositories\Reservations;

use App\Database;
use App\Models\Reservation;
use App\Repositories\Reviews\ReviewsRepository;

class MySqlReservationRepository implements ReservationRepository
{
    public function reservation(int $apartmentId): Reservation
    {
        $reservationQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('reservations')
            ->where('id = ?')
            ->setParameter(0, $apartmentId)
            ->executeQuery()
            ->fetchAssociative();

        return new Reservation(
            $reservationQuery['reserve_from'],
            $reservationQuery['reserve_to'],
            $reservationQuery['user_id'],
            $reservationQuery['apartment_id'],
            $reservationQuery['id'],
        );
    }

    public function confirm(string $reservationFrom, string $reservationTo, int $userId, int $apartmentId)
    {
        Database::connection()
            ->insert('reservations', [
                'reserve_from' => $reservationFrom,
                'reserve_to' => $reservationTo,
                'user_id' => $userId,
                'apartment_id' => $apartmentId,
            ]);
    }
}