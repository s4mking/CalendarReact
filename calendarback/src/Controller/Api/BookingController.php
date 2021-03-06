<?php

namespace App\Controller\Api;

use DateTime;
use App\Entity\Booking;
use App\EventSubscriber\CalendarSubscriber;
use App\Form\BookingType;
use FOS\RestBundle\View\View;
use App\Repository\BookingRepository;
use App\Repository\UserRepository;
use App\Service\Calendar;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use PhpParser\Node\Expr\Cast;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class BookingController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/bookings", name="api_get_all_bookings")
     * @Rest\View(serializerGroups={"event"})
     */
    public function index(BookingRepository $bookingRepository)
    {
        return View::create($bookingRepository->findAll(), Response::HTTP_OK);
    }


    /**
     * Creates an Article resource
     * @Rest\Post("/bookings", name="api_post_booking")
     * @Rest\View(serializerGroups={"event"})
     * @param Request $request
     * @return View
     */

    public function postBooking(Request $request, UserRepository $user): View
    {
        $booking = new Booking();
        // $form = $this->createForm(BookingType::class, $booking);
        // $form->handleRequest($request);
        // $test = new DateTime($request->get('beginAt'));
        $booking->setEndAt(new DateTime($request->get('beginAt')));
        $booking->setBeginAt(new DateTime($request->get('endAt')));
        $booking->setTitle($request->get('title'));
        $userTest = $user->findById($request->get('creator')['id']);
        $booking->setCreator($this->getUser());
        $booking->setSubscribedUser($request->get('subscribed_user_id'));
        // if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($booking);
        $entityManager->flush();
        return View::create($booking, Response::HTTP_CREATED);
        // }
    }


    /**
     * Retrieves an Article resource
     * @Rest\Get("/bookings/{id}", name="api_get_booking")
     * @Rest\View(serializerGroups={"event"})
     * @ParamConverter()
     */
    public function getBooking(Booking $booking): View
    {
        return View::create($booking, Response::HTTP_OK);
    }


    /**
     * @Rest\Put("/bookings/{id}", name="api_put_booking")
     * @Rest\View(serializerGroups={"event"})
     * @param Request $request
     * @return View
     */
    public function putBooking(Request $request, Booking $booking): View
    {
        dd(($this->container->get('security.token_storage')->getToken()));
        // $form = $this->createForm(BookingType::class, $booking);
        // $form->handleRequest($request);
        $booking->setEndAt(new DateTime($request->get('beginAt')));
        $booking->setBeginAt(new DateTime($request->get('endAt')));
        $booking->setTitle($request->get('title'));
        // $userTest = $user->findById($request->get('creator')['id']);
        $booking->setCreator($this->getUser());
        $booking->setSubscribedUser($request->get('subscribed_user_id'));
        // if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($booking);
        $entityManager->flush();
        return View::create($booking, Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("/bookings/{id}", name="api_del_booking")
     * @ParamConverter()
     */
    public function deleteBooking(Request $request, Booking $booking): View
    {
        if ($this->isCsrfTokenValid('delete' . $booking->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($booking);
            $entityManager->flush();
        }
        return View::create([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Retrieves all month events
     * @Rest\Post("/calendar", name="api_get_calendar_month")
     * @Rest\View(serializerGroups={"event"})
     * @ParamConverter()
     */
    public function getCalendar(Request $request, Calendar $calendar): View
    {
        return View::create($calendar->calendarMonthly($request->get('month')), Response::HTTP_OK);
    }

    /**
     * @Rest\Post("/bookings/{id}/unsuscribe", name="api_unsuscribe_booking")
     * @Rest\View(serializerGroups={"event"})
     * @ParamConverter()
     */
    public function unsuscribeBooking(Request $request, Booking $booking): View
    {
        $user = $this->getUser();
        $user->removeBookingsReserved($booking);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        return View::create($booking, Response::HTTP_OK);
    }
    /**
     * @Rest\Post("/bookings/{id}", name="api_suscribe_booking")
     * @Rest\View(serializerGroups={"event"})
     * @ParamConverter()
     */
    public function suscribeBooking(Request $request, Booking $booking): View
    {
        $booking->setSubscribedUser($this->getUser());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($booking);
        $entityManager->flush();
        return View::create($booking, Response::HTTP_OK);
    }
}
