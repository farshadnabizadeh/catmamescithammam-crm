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
use App\Models\ReservationTherapist;
use App\Models\ReservationService;
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
            //Reservation Source
            $sources = Reservation::select('sources.*', DB::raw('source_id, count(source_id) as sourceCount'))
                ->leftJoin('sources', 'reservations.source_id', '=', 'sources.id')
                ->whereNotIn('reservations.source_id', [12,13,14,15])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1, 12]);
                    });
                })
                ->groupBy('source_id')
                ->get();

            $subSourceCount = Reservation::whereIn('reservations.source_id', [12,13,14,15])
                ->count();
            $subSourcesCount = Reservation::whereIn('reservations.source_id', [1])
                ->count();

            $sourceLabels = [];
            $sourceData = [];
            $sourceColors = [];

            foreach ($sources as $source) {


                if ($subSourceCount > 0) {
                    if ($source->source->id == 1) {
                        array_push($sourceData, ($source->sourceCount + $subSourceCount));
                        array_push($sourceLabels, $source->source->name);
                        array_push($sourceColors, $source->source->color);
                    } else {
                        array_push($sourceData, $source->sourceCount);
                        array_push($sourceLabels, $source->source->name);
                        array_push($sourceColors, $source->source->color);
                    }
                }
            }
            if ($subSourcesCount == 0) {
                array_push($sourceData, $subSourceCount);
                array_push($sourceLabels, 'GOOGLE');
                array_push($sourceColors, '#276cb8');
            }



            $therapistAll = ReservationTherapist::select('therapists.*', DB::raw('therapist_id, sum(piece) as therapistCount'))
                ->leftJoin('therapists', 'reservations_therapists.therapist_id', '=', 'therapists.id')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_therapists.reservation_id')
                ->groupBy('therapist_id')
                ->orderBy('therapistCount', 'desc')
                ->get();

            $therapistLabels = [];
            $therapistData = [];
            $therapistColors = [];

            foreach ($therapistAll as $therapist) {
                array_push($therapistLabels, $therapist->name);
                array_push($therapistData, $therapist->therapistCount);
                $therapistColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            }

            $serviceAll = ReservationService::select('services.*', DB::raw('service_id, sum(piece) as serviceCount'))
            ->leftJoin('services', 'reservations_services.service_id', '=', 'services.id')
            ->leftJoin('reservations', 'reservations.id', '=', 'reservations_services.reservation_id')
            ->groupBy('service_id')
            ->orderBy('serviceCount', 'desc')
            ->get();
            $serviceLabels = [];
            $serviceData = [];
            $serviceColors = [];

            foreach ($serviceAll as $service) {
                array_push($serviceLabels, $service->name);
                array_push($serviceData, $service->serviceCount);
                $serviceColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            }
            $dashboard = array(
                'sourceLabels'             => $sourceLabels,
                'sourceData'               => $sourceData,
                'sourceColors'             => $sourceColors,
                'therapistLabels'          => $therapistLabels,
                'therapistData'            => $therapistData,
                'therapistColors'          => $therapistColors,
                'serviceLabels'          => $serviceLabels,
                'serviceData'            => $serviceData,
                'serviceColors'          => $serviceColors,
                'lastReservations' => $lastReservations,
                'customerCount' => $customerCount,
                'hotelCount' => $hotelCount,
                'serviceCount' => $serviceCount,
                'therapistCount' => $therapistCount,
                'reservationCount' => $reservationCount,
                'contactFormCount' => $contactFormCount,
                'bookingFormCount' => $bookingFormCount);

            if ($user->hasRole('Performance Marketing Admin')) {
                //Ciro Report
                $all_payments = ReservationPaymentType::select('payment_types.*', DB::raw('payment_type_id, sum(payment_price) as totalPrice'))
                    ->leftJoin('payment_types', 'reservations_payments_types.payment_type_id', '=', 'payment_types.id')
                    ->leftJoin('reservations', 'reservations.id', '=', 'payment_types.id')
                    ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,12,13,14,15]);
                    });
                })
                    ->groupBy('payment_type_id')
                    ->get();
                $payments_customer_count = ReservationPaymentType::leftJoin('reservations', 'reservations_payments_types.reservation_id', '=', 'reservations.id')
                    ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,12,13,14,15]);
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
                        $query->whereIn('reservations.source_id', [1,12,13,14,15]);
                    });
                })
                    ->sum("payment_price");

                $cashEur = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '6')
                    ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                    ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,12,13,14,15]);
                    });
                })
                    ->sum("payment_price");

                $cashUsd = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '7')
                    ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                    ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,12,13,14,15]);
                    });
                })
                    ->sum("payment_price");

                $cashPound = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '8')
                    ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                    ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,12,13,14,15]);
                    });
                })
                    ->sum("payment_price");

                $ykbTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '9')
                    ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                    ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,12,13,14,15]);
                    });
                })
                    ->sum("payment_price");

                $ziraatTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '10')
                    ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                    ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,12,13,14,15]);
                    });
                })
                    ->sum("payment_price");

                $ziraatEuro = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '11')
                    ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                    ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,12,13,14,15]);
                    });
                })
                    ->sum("payment_price");

                $ziraatDolar = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '12')
                    ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                    ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,12,13,14,15]);
                    });
                })
                    ->sum("payment_price");

                $viatorEuro = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '13')
                    ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                    ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,12,13,14,15]);
                    });
                })
                    ->sum("payment_price");

                $all_payments = ReservationPaymentType::select('payment_types.*', DB::raw('payment_type_id, sum(payment_price) as totalPrice'))
                    ->leftJoin('payment_types', 'reservations_payments_types.payment_type_id', '=', 'payment_types.id')
                    ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                    ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,12,13,14,15]);
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
                    'sourceLabels'             => $sourceLabels,
                    'sourceData'               => $sourceData,
                    'sourceColors'             => $sourceColors,
                    'payments_customer_count'  => $payments_customer_count,
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
            } else {
                return view('home')->with($dashboard);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
