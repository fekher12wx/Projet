<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookingController extends AbstractController
{
    #[Route('/booking', name: 'app_booking')]
    public function listBooking(BookingRepository $bookingRepository): Response{
        $bookings = $bookingRepository->findAll();
        return $this->render('booking/listBooking.html.twig', ['booking' => $bookings]);
    }
}
