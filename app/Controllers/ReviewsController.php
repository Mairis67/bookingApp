<?php

namespace App\Controllers;

use App\Database;
use App\Redirect;

class ReviewsController
{
    public function review(array $vars): Redirect
    {
        $apartmentId = (int) $vars['id'];

        Database::connection()
            ->insert('apartment_reviews', [
                'apartment_id' => $apartmentId,
                'author_id' => $_SESSION['id'],
                'author' => $_SESSION['username'],
                'review' => $_POST['review'],
            ]);

        Database::connection()
            ->update('apartments', [
            ], ['id' => $apartmentId]
            );

        return new Redirect('/apartments' . $apartmentId);
    }

    public function delete(array $vars): Redirect
    {
        $reviewQuery = Database::connection()
            ->createQueryBuilder()
            ->select('*')
            ->from('apartment_reviews')
            ->where('id = ?')
            ->setParameter(0, (int) $vars['id'])
            ->executeQuery()
            ->fetchAssociative();

        if((int) $_SESSION['userid'] === $reviewQuery['author_id']) {
            Database::connection()
                ->delete('apartment_reviews', ['id' => (int) $vars['id']]);
        }

        return new Redirect('/apartments/'  . (int) $vars['nr']);
    }
}