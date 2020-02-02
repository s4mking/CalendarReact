<?php

namespace App\Service;


use App\Repository\BookingRepository;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class Calendar
{
    private $bookingRepository;
    private $router;

    public function __construct(
        BookingRepository $bookingRepository,
        UrlGeneratorInterface $router
    ) {
        $this->bookingRepository = $bookingRepository;
        $this->router = $router;
    }

    public function calendarMonthly($month)
    {
        //pour linstant le format des daates ce sera send en ract 2012-06-02????
        // $filters = $calendar->getFilters();
        $firstMonthDay = date('Y-m-01 H:i:s', strtotime($month));
        $lastDayMonth = date('Y-m-t H:i:s', strtotime($month));
        // Modify the query to fit to your entity and needs
        // Change booking.beginAt by your start date property
        $bookings = $this->bookingRepository
            ->createQueryBuilder('booking')
            ->where('booking.beginAt BETWEEN :start and :end OR booking.endAt BETWEEN :start and :end')
            ->setParameter('start', $firstMonthDay)
            ->setParameter('end', $lastDayMonth)
            ->getQuery()
            ->getResult();
        return $bookings;
        // foreach ($bookings as $booking) {
        // this create the events with your data (here booking data) to fill calendar
        // $bookingEvent = new Event(
        //     $booking->getTitle(),
        //     $booking->getBeginAt(),
        //     $booking->getEndAt() // If the end date is null or not defined, a all day event is created.
        // );

        /*
             * Add custom options to events
             *
             * For more information see: https://fullcalendar.io/docs/event-object
             * and: https://github.com/fullcalendar/fullcalendar/blob/master/src/core/options.ts
             */

        // $bookingEvent->setOptions([
        //     'backgroundColor' => 'red',
        //     'borderColor' => 'red',
        // ]);
        // $bookingEvent->addOption(
        //     'url',
        //     $this->router->generate('api_get_booking', [
        //         'id' => $booking->getId(),
        //     ])
        // );

        // finally, add the event to the CalendarEvent to fill the calendar
        // $calendar->addEvent($bookingEvent);
        // }
    }
}
