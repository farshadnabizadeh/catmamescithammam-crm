<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Hotel;
use App\Models\ContactForm;
use App\Models\BookingForm;
use App\Models\Service;
use App\Models\Reservation;
use App\Models\Therapist;
use App\Models\ReservationPaymentType;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $user = auth()->user();
            $lastReservations = Reservation::latest()->take(5)->get();

            $customerCount = Customer::count();
            $hotelCount = Hotel::count();
            $serviceCount = Service::count();
            $therapistCount = Therapist::count();
            $reservationCount = Reservation::count();
            $contactFormCount = ContactForm::count();
            $bookingFormCount = BookingForm::count();

            $dashboard = array('lastReservations' => $lastReservations, 'customerCount' => $customerCount, 'hotelCount' => $hotelCount, 'serviceCount' => $serviceCount, 'therapistCount' => $therapistCount, 'reservationCount' => $reservationCount, 'contactFormCount' => $contactFormCount, 'bookingFormCount' => $bookingFormCount);

            if ($user->hasRole('Performance Marketing Admin')) {
                //Ciro Report
            $all_payments = ReservationPaymentType::select('payment_types.*', DB::raw('payment_type_id, sum(payment_price) as totalPrice'))
                ->leftJoin('payment_types', 'reservations_payments_types.payment_type_id', '=', 'payment_types.id')
                ->leftJoin('reservations', 'reservations.id', '=', 'payment_types.id')
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->where('reservations.source_id', '=', 1)
                                ->orWhere('reservations.source_id', '=', 12);
                    });
                })
                ->groupBy('payment_type_id')
                ->get();
            $payments_customer_count = ReservationPaymentType::leftJoin('reservations', 'reservations_payments_types.reservation_id', '=', 'reservations.id')
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->where('reservations.source_id', '=', 1)
                            ->orWhere('reservations.source_id', '=', 12);
                        });
                    })
                ->sum('reservations.total_customer');
            $all_paymentLabels = [];
            $all_paymentData = [];
            $all_paymentColors = [];
            foreach ($all_payments as $all_payment) {
                array_push($all_paymentLabels, $all_payment->type_name);
                array_push($all_paymentData, $all_payment->totalPrice);
                $all_paymentColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            }

            $cashTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '5')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->where('reservations.source_id', '=', 1)
                            ->orWhere('reservations.source_id', '=', 12);
                        });
                    })
                ->sum("payment_price");

            $cashEur = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '6')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->where('reservations.source_id', '=', 1)
                            ->orWhere('reservations.source_id', '=', 12);
                        });
                    })
                ->sum("payment_price");

            $cashUsd = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '7')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->where('reservations.source_id', '=', 1)
                            ->orWhere('reservations.source_id', '=', 12);
                        });
                    })
                ->sum("payment_price");

            $cashPound = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '8')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->where('reservations.source_id', '=', 1)
                            ->orWhere('reservations.source_id', '=', 12);
                        });
                    })
                ->sum("payment_price");

            $ykbTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '9')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->where('reservations.source_id', '=', 1)
                            ->orWhere('reservations.source_id', '=', 12);
                        });
                    })
                ->sum("payment_price");

            $ziraatTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '10')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->where('reservations.source_id', '=', 1)
                            ->orWhere('reservations.source_id', '=', 12);
                        });
                    })
                ->sum("payment_price");

            $ziraatEuro = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '11')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->where('reservations.source_id', '=', 1)
                            ->orWhere('reservations.source_id', '=', 12);
                        });
                    })
                ->sum("payment_price");

            $ziraatDolar = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '12')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->where('reservations.source_id', '=', 1)
                            ->orWhere('reservations.source_id', '=', 12);
                        });
                    })
                ->sum("payment_price");

            $viatorEuro = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '13')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->where('reservations.source_id', '=', 1)
                            ->orWhere('reservations.source_id', '=', 12);
                        });
                    })
                ->sum("payment_price");

            $all_payments = ReservationPaymentType::select('payment_types.*', DB::raw('payment_type_id, sum(payment_price) as totalPrice'))
                ->leftJoin('payment_types', 'reservations_payments_types.payment_type_id', '=', 'payment_types.id')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->where('reservations.source_id', '=', 1)
                            ->orWhere('reservations.source_id', '=', 12);
                        });
                    })
                ->groupBy('payment_type_id')
                ->get();

            $open = simplexml_load_file('https://www.tcmb.gov.tr/kurlar/today.xml');

            $euro_satis = $open->Currency[3]->BanknoteSelling;
            $usd_satis = $open->Currency[0]->BanknoteSelling;
            $gbp_satis = $open->Currency[4]->BanknoteSelling;
            $euro_usd_satis = $open->Currency[3]->CrossRateOther;

            $totalUsd = $cashUsd + $ziraatDolar;

            $totalPound = $cashPound;

            //only need pound convert
            $totalEuro = $cashEur + $ziraatEuro + $viatorEuro + $cashUsd * $euro_usd_satis + (($totalPound * $gbp_satis) / $euro_satis) + $ziraatDolar * $euro_usd_satis + $cashTl / $euro_satis + $ykbTl / $euro_satis + $ziraatTl / $euro_satis;

            $totalTl = $cashTl + $ykbTl + $ziraatTl + $cashEur * $euro_satis + $ziraatEuro * $euro_satis + $viatorEuro * $euro_satis + $totalUsd * $usd_satis + $totalPound * $gbp_satis;

            $all_paymentLabels = [];
            $all_paymentData = [];
            $all_paymentColors = [];
            foreach ($all_payments as $all_payment) {
                array_push($all_paymentLabels, $all_payment->type_name);
                array_push($all_paymentData, $all_payment->totalPrice);
                $all_paymentColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            }
            $dashboard = array(
                'payments_customer_count'  => $payments_customer_count ,
                'all_paymentLabels'        => $all_paymentLabels,
                'all_paymentData'          => $all_paymentData,
                'all_paymentColors'        => $all_paymentColors,
                'cashTl'                   => $cashTl,
                'cashEur'                  => $cashEur,
                'cashUsd'                  => $cashUsd,
                'cashPound'                => $cashPound,
                'ykbTl'                    => $ykbTl,
                'ziraatTl'                 => $ziraatTl,
                'ziraatEuro'               => $ziraatEuro,
                'ziraatDolar'              => $ziraatDolar,
                'viatorEuro'               => $viatorEuro,
                'totalEuro'                => $totalEuro,
                'totalTl'                  => $totalTl,
            );
                return view('home_pm')->with($dashboard);
            }else {
                return view('home')->with($dashboard);
            }
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
