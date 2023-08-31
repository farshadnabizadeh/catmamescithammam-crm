<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ReservationPaymentType;
use App\Models\ReservationComission;
use App\Models\ReservationTherapist;
use App\Models\ReservationService;
use App\Models\Reservation;
use App\Models\Therapist;
use App\Models\Service;
use App\Models\Source;
use App\Models\Guide;
use App\Models\Hotel;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $start = $request->input('startDate');
        $end = $request->input('endDate');
        $user = auth()->user();

        $reservations = Reservation::with('subHotelComissions','subGuideComissions')
            ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
            ->when($user->hasRole('Sales Admin'), function ($query) {
                $query->where(function ($query) {
                    $query->whereIn('reservations.source_id', [3]);
                })
                ->orderBy('reservation_date', 'ASC');
            })
            ->get();

        $totalPax = Reservation::whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
        ->when($user->hasRole('Sales Admin'), function ($query) {
            $query->where(function ($query) {
                $query->whereIn('reservations.source_id', [3]);
            });
        })
        ->sum('total_customer');

       $totalComission = Reservation::select('reservations.*', 'reservations_comissions.hotel_id', 'reservations_comissions.guide_id')
            ->leftJoin('reservations_comissions', 'reservations_comissions.reservation_id', '=', 'reservations.id')
            ->when($user->hasRole('Sales Admin'), function ($query) {
                $query->where(function ($query) {
                    $query->whereIn('reservations.source_id', [3]);
                });
            })
            ->whereNull('reservations_comissions.deleted_at')
            ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
            ->sum('comission_price');

        $comissionNames = Reservation::select('reservations.*','sources.id as sId', 'sources.color', 'sources.name', 'reservations_comissions.hotel_id','hotels.name as hName','hotels.name as hName','reservations_comissions.guide_id','guides.name as gName')
            ->leftJoin('sources', 'reservations.source_id', '=', 'sources.id')
            ->leftJoin('reservations_comissions', 'reservations_comissions.reservation_id', '=', 'reservations.id')
            ->leftJoin('hotels', 'hotels.id', '=', 'reservations_comissions.hotel_id')
            ->leftJoin('guides', 'guides.id', '=', 'reservations_comissions.guide_id')
            ->when($user->hasRole('Sales Admin'), function ($query) {
                $query->where(function ($query) {
                    $query->whereIn('reservations.source_id', [3]);
                });
            })
            ->whereNull('reservations_comissions.deleted_at')
            ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
            ->get();

        $cashTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '5')
            ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
            ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
            ->when($user->hasRole('Sales Admin'), function ($query) {
                $query->where(function ($query) {
                    $query->whereIn('reservations.source_id', [3]);
                });
            })
            ->whereNull('reservations.deleted_at')
            ->sum("payment_price");

        $cashEur = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '6')
            ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
            ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
            ->whereNull('reservations.deleted_at')
            ->sum("payment_price");

        $cashUsd = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '7')
            ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
            ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
            ->when($user->hasRole('Sales Admin'), function ($query) {
                $query->where(function ($query) {
                    $query->whereIn('reservations.source_id', [3]);
                });
            })
            ->whereNull('reservations.deleted_at')
            ->sum("payment_price");

        $cashPound = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '8')
            ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
            ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
            ->when($user->hasRole('Sales Admin'), function ($query) {
                $query->where(function ($query) {
                    $query->whereIn('reservations.source_id', [3]);
                });
            })
            ->whereNull('reservations.deleted_at')
            ->sum("payment_price");

        $ykbTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '9')
            ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
            ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
            ->when($user->hasRole('Sales Admin'), function ($query) {
                $query->where(function ($query) {
                    $query->whereIn('reservations.source_id', [3]);
                });
            })
            ->whereNull('reservations.deleted_at')
            ->sum("payment_price");

        $ziraatTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '10')
            ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
            ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
            ->when($user->hasRole('Sales Admin'), function ($query) {
                $query->where(function ($query) {
                    $query->whereIn('reservations.source_id', [3]);
                });
            })
            ->whereNull('reservations.deleted_at')
            ->sum("payment_price");

        $ziraatEuro = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '11')
            ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
            ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
            ->when($user->hasRole('Sales Admin'), function ($query) {
                $query->where(function ($query) {
                    $query->whereIn('reservations.source_id', [3]);
                });
            })
            ->whereNull('reservations.deleted_at')
            ->sum("payment_price");

        $ziraatDolar = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '12')
            ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
            ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
            ->when($user->hasRole('Sales Admin'), function ($query) {
                $query->where(function ($query) {
                    $query->whereIn('reservations.source_id', [3]);
                });
            })
            ->whereNull('reservations.deleted_at')
            ->sum("payment_price");

        $viatorEuro = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '13')
            ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
            ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
            ->when($user->hasRole('Sales Admin'), function ($query) {
                $query->where(function ($query) {
                    $query->whereIn('reservations.source_id', [3]);
                });
            })
            ->whereNull('reservations.deleted_at')
            ->sum("payment_price");

        $data = array(
                'cashTl'                   => $cashTl,
                'cashEur'                  => $cashEur,
                'cashUsd'                  => $cashUsd,
                'cashPound'                => $cashPound,
                'ykbTl'                    => $ykbTl,
                'ziraatTl'                 => $ziraatTl,
                'ziraatEuro'               => $ziraatEuro,
                'ziraatDolar'              => $ziraatDolar,
                'viatorEuro'               => $viatorEuro,
                'comissionNames'           => $comissionNames,
                'reservations'             => $reservations,
                'totalPax'                 => $totalPax,
                'totalComission'           => $totalComission,
                'start'                    => $start,
                'end'                      => $end);
        if ($user->hasRole('Sales Admin')) {
            return view('admin.reports.index_salesAdmin')->with($data);
        }else {
            return view('admin.reports.index')->with($data);
        }
    }

    public function reservationReport(Request $request)
    {
        try {

            $start = $request->input('startDate');
            $end = $request->input('endDate');
            $sourcesSelect = Source::whereNotIn('id',[12,13,14,15])->get();
            $salesSelect   = Reservation::whereNotNull('sales_person_name')->groupBy('sales_person_name')->get();
            $selectedSales = $request->input('selectedSales', []);
            $user = auth()->user();

            $selectedSources = $request->input('selectedSource', []); // original variable

            $old_id = '1'; // ID to be replaced
            $new_ids = ['13', '14', '15', '12']; // new IDs to replace the old ID

            // replace the old ID with the new IDs for all IDs
            $selectedSources = array_map(function($id) use ($old_id, $new_ids) {
                return ($id === $old_id) ? $new_ids : [$id];
            }, $selectedSources);

            // flatten the array of arrays into a single array
            $selectedSources = array_merge(...$selectedSources);

            $reservationsAll = Reservation::select('reservations.*', DB::raw('count(id) as reservationCount'))
                ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })
                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->groupBy('reservations.id')
                ->get();

            $therapistAll = ReservationTherapist::select('therapists.*', DB::raw('therapist_id, sum(piece) as therapistCount'))
                ->leftJoin('therapists', 'reservations_therapists.therapist_id', '=', 'therapists.id')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_therapists.reservation_id')
                ->whereBetween('reservations.reservation_date', [$start, $end])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->groupBy('therapist_id')
                ->get();

            $serviceAll = ReservationService::select('services.*', DB::raw('service_id, sum(piece) as serviceCount'))
                ->leftJoin('services', 'reservations_services.service_id', '=', 'services.id')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_services.reservation_id')
                ->whereBetween('reservations.reservation_date', [$start, $end])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->groupBy('service_id')
                ->get();

                $sourcesAll = Reservation::select('sources.*', 'reservations.*', DB::raw('source_id, count(source_id) as sourceCount, sum(total_customer) as paxCount'))
                ->leftJoin('sources', 'reservations.source_id', '=', 'sources.id')
                ->whereNotIn('reservations.source_id',[12,13,14,15])
                ->whereBetween('reservations.reservation_date', [$start, $end])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->groupBy('source_id')
                ->orderBy('sourceCount', 'DESC')
                ->get();


                $byCountry = Reservation::select('customers.*', 'reservations.*', DB::raw('customer_id, count(customer_id) as customerCount, sum(total_customer) as paxCount'))
                ->leftJoin('customers', 'reservations.customer_id', '=', 'customers.id')
                ->whereBetween('reservations.reservation_date', [$start, $end])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->groupBy('customers.country')
                ->orderBy('customerCount', 'ASC')
                ->get();
                $byCountryLabels = [];
                $byCountryData = [];
                $byCountryColors = [];

                foreach ($byCountry as $country) {
                    array_push($byCountryLabels, $country->country);
                    array_push($byCountryData, $country->customerCount);
                    $byCountryColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                }

                $salesPersons = Reservation::select('reservations.*', DB::raw('sales_person_name, count(sales_person_name) as salesCount, sum(total_customer) as paxCount'))
                ->whereBetween('reservations.reservation_date', [$start, $end])
                ->whereNotNull('sales_person_name')
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->groupBy('sales_person_name')
                ->orderBy('salesCount', 'DESC')
                ->get();

                $salesPersonLabels = [];
                $salesPersonData = [];
                $salesPersonColors = [];

                foreach ($salesPersons as $sale) {
                    array_push($salesPersonLabels, $sale->sales_person_name);
                    array_push($salesPersonData, $sale->salesCount);
                    $salesPersonColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                }
                $googleSources = Reservation::select('sources.*', 'reservations.*', DB::raw('source_id, count(source_id) as sourceGoogleCount, sum(total_customer) as paxGoogleCount'))
                ->leftJoin('sources', 'reservations.source_id', '=', 'sources.id')
                ->whereIn('reservations.source_id',[1,13,12,14,15])
                ->whereBetween('reservations.reservation_date', [$start, $end])
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->groupBy('source_id')
                ->orderBy('sourceGoogleCount', 'DESC')
                ->get();
            $sourcesAllByDate = Reservation::select('sources.*', 'reservations.*', DB::raw('source_id, count(source_id) as sourceCount, sum(total_customer) as paxCount'))
                ->leftJoin('sources', 'reservations.source_id', '=', 'sources.id')
                ->whereBetween('reservations.reservation_date', [$start, $end])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->groupBy('reservation_date')
                ->get();

            $reservationByDateCount = Reservation::whereBetween('reservations.reservation_date', [$start, $end])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->count('source_id');

            $paxByDateCount = Reservation::whereBetween('reservations.reservation_date', [$start, $end])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->sum('total_customer');

            $therapistLabels = [];
            $therapistData = [];
            $therapistColors = [];

            foreach ($therapistAll as $therapist) {
                array_push($therapistLabels, $therapist->name);
                array_push($therapistData, $therapist->therapistCount);
                $therapistColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            }

            $serviceLabels = [];
            $serviceData = [];
            $serviceColors = [];

            foreach ($serviceAll as $service) {
                array_push($serviceLabels, $service->name);
                array_push($serviceData, $service->serviceCount);
                $serviceColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            }
            //Reservation Source
            $sources = Reservation::select('sources.*', DB::raw('source_id, count(source_id) as sourceCount'))
                ->leftJoin('sources', 'reservations.source_id', '=', 'sources.id')
                ->whereNotIn('reservations.source_id',[12,13,14,15])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->whereBetween('reservations.reservation_date', [$start, $end])
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->groupBy('source_id')
                ->orderBy('sourceCount', 'DESC')
                ->get();

                $subSourceCount = Reservation::whereIn('reservations.source_id',[12,13,14,15])
                    ->whereBetween('reservations.reservation_date', [$start, $end])
                    ->count();
                $subSourcePax = Reservation::whereIn('reservations.source_id',[12,13,14,15])
                ->whereBetween('reservations.reservation_date', [$start, $end])
                ->sum('total_customer');
                $subSourcesCount = Reservation::whereIn('reservations.source_id',[1])
                    ->whereBetween('reservations.reservation_date', [$start, $end])
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
                }else {
                    array_push($sourceData, $source->sourceCount);
                    array_push($sourceLabels, $source->source->name);
                    array_push($sourceColors, $source->source->color);
                }
            }

            }
            if ($subSourcesCount == 0) {
                if ($user->hasRole('Sales Admin')) {
                }else{
                    array_push($sourceData, $subSourceCount);
                    array_push($sourceLabels, 'GOOGLE');
                    array_push($sourceColors, '#276cb8');
                }
            }
            //google Sources
            $googleSourcesChart = Reservation::select('sources.*', DB::raw('source_id, count(source_id) as googleSourceCount'))
            ->leftJoin('sources', 'reservations.source_id', '=', 'sources.id')
            ->whereIn('reservations.source_id',[1,13,12,14,15])
            ->whereBetween('reservations.reservation_date', [$start, $end])
            ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                $query->whereIn('reservations.source_id', $selectedSources);
            }, function ($query) {
                $query->whereNotNull('reservations.source_id');
            })
            ->groupBy('source_id')
            ->orderBy('googleSourceCount', 'DESC')
            ->get();
            $googleSourceLabels = [];
            $googleSourceData = [];
            $googleSourceColors = [];

            foreach ($googleSourcesChart as $source) {
                array_push($googleSourceData, $source->googleSourceCount);
                array_push($googleSourceLabels, $source->source->name);
                array_push($googleSourceColors, $source->source->color);
            }
            //Reservation Source By Date
            $sourcesByDate = Reservation::select('sources.*', 'reservations.*', DB::raw('source_id, count(source_id) as sourceCount'))
                ->leftJoin('sources', 'reservations.source_id', '=', 'sources.id')
                ->whereBetween('reservations.reservation_date', [$start, $end])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })
                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->groupBy('reservation_date')
                ->get();
            $sourcesByDateLabels = [];
            $sourcesByDateData = [];
            $sourcesByDateColors = [];
            foreach ($sourcesByDate as $source) {
                array_push($sourcesByDateLabels, $source->reservation_date);
                array_push($sourcesByDateData, $source->sourceCount);
                $sourcesByDateColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            }
            //Ciro Report
            $all_payments = ReservationPaymentType::select('payment_types.*', DB::raw('payment_type_id, sum(payment_price) as totalPrice'))
                ->leftJoin('payment_types', 'reservations_payments_types.payment_type_id', '=', 'payment_types.id')
                ->leftJoin('reservations', 'reservations.id', '=', 'payment_types.id')
                ->whereBetween('reservations.reservation_date', [$start, $end])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->groupBy('payment_type_id')
                ->get();
            $payments_customer_count = ReservationPaymentType::leftJoin('reservations', 'reservations_payments_types.reservation_id', '=', 'reservations.id')
                ->whereBetween('reservations.reservation_date', [$start, $end])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
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
                ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->sum("payment_price");

            $cashEur = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '6')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->sum("payment_price");

            $cashUsd = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '7')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->sum("payment_price");

            $cashPound = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '8')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->sum("payment_price");

            $ykbTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '9')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->sum("payment_price");

            $ziraatTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '10')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->sum("payment_price");

            $ziraatEuro = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '11')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->sum("payment_price");

            $ziraatDolar = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '12')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->sum("payment_price");

            $viatorEuro = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '13')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->sum("payment_price");

            $hotelistanVPEuro = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '16')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })
                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->sum("payment_price");

                $hotelistanVPUsd = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '17')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })
                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->sum("payment_price");
                $hotelistanVPTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '18')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })
                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->sum("payment_price");
                $hotelistanVPGbp = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '19')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })
                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->sum("payment_price");

            $all_payments = ReservationPaymentType::select('payment_types.*', DB::raw('payment_type_id, sum(payment_price) as totalPrice'))
                ->leftJoin('payment_types', 'reservations_payments_types.payment_type_id', '=', 'payment_types.id')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
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
            $totalEuro = ($hotelistanVPUsd * $euro_usd_satis)+ $hotelistanVPEuro + $cashEur + $ziraatEuro + $viatorEuro + $cashUsd * $euro_usd_satis + (($hotelistanVPGbp * $gbp_satis) / $euro_satis)+ (($totalPound * $gbp_satis) / $euro_satis) + $ziraatDolar * $euro_usd_satis + $hotelistanVPTl / $euro_satis + $cashTl / $euro_satis + $ykbTl / $euro_satis + $ziraatTl / $euro_satis;

            $totalTl = ($hotelistanVPUsd * $usd_satis) + ($hotelistanVPEuro * $euro_satis) + $hotelistanVPTl + $cashTl + $ykbTl + $ziraatTl + $cashEur * $euro_satis + $ziraatEuro * $euro_satis + $viatorEuro * $euro_satis + $totalUsd * $usd_satis + $totalPound * $gbp_satis + $hotelistanVPGbp * $gbp_satis;

            $all_paymentLabels = [];
            $all_paymentData = [];
            $all_paymentColors = [];
            foreach ($all_payments as $all_payment) {
                array_push($all_paymentLabels, $all_payment->type_name);
                array_push($all_paymentData, $all_payment->totalPrice);
                $all_paymentColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            }
            // comission reports


            $hotelComissions = ReservationComission::select('hotels.*', DB::raw('hotel_id, sum(comission_price) as totalPrice'))
                ->leftJoin('hotels', 'reservations_comissions.hotel_id', '=', 'hotels.id')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_comissions.reservation_id')
                ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->whereNull('reservations_comissions.guide_id')
                ->where('reservations_comissions.comission_price', '!=', NULL)
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->groupBy('hotel_id')
                ->orderBy('totalPrice', 'DESC')
                ->get();
            $hotelComissionsCount = ReservationComission::leftJoin('reservations', 'reservations.id', '=', 'reservations_comissions.reservation_id')
                ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->where('guide_id', NULL)
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->sum('comission_price');
            $guideComissions = ReservationComission::select('guides.*', DB::raw('guide_id, sum(comission_price) as totalPrice'))
                ->leftJoin('guides', 'reservations_comissions.guide_id', '=', 'guides.id')
                ->leftJoin('reservations', 'reservations.id', '=', 'reservations_comissions.reservation_id')
                ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->whereNull('reservations_comissions.hotel_id')
                ->where('reservations_comissions.comission_price', '!=', NULL)
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->groupBy('guide_id')
                ->orderBy('totalPrice', 'DESC')
                ->get();

            $guideComissionsCount = ReservationComission::leftJoin('reservations', 'reservations.id', '=', 'reservations_comissions.reservation_id')
                ->whereBetween('reservations.reservation_date', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->where('hotel_id', NULL)
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->sum('comission_price');
            $hotelComissionLabels = [];
            $hotelComissionData = [];
            $hotelComissionColors = [];

            foreach ($hotelComissions as $hotelComission) {
                array_push($hotelComissionLabels, $hotelComission->name);
                array_push($hotelComissionData, $hotelComission->totalPrice);
                $hotelComissionColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            }

            $guideComissionLabels = [];
            $guideComissionData = [];
            $guideComissionColors = [];

            foreach ($guideComissions as $guideComission) {
                array_push($guideComissionLabels, $guideComission->name);
                array_push($guideComissionData, $guideComission->totalPrice);
                $guideComissionColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            }

            $sourcesPayment = DB::table('sources')
                ->leftJoin('reservations', 'sources.id', '=', 'reservations.source_id')
                ->leftJoin('reservations_payments_types', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->leftJoin('payment_types', 'reservations_payments_types.payment_type_id', '=', 'payment_types.id')
                ->select(
                    'sources.id',
                    DB::raw('IF(sources.id IN (12, 13, 14, 15), "Google", sources.name) AS name'),
                    'payment_types.type_name',
                    'reservations_payments_types.payment_type_id',
                    DB::raw('SUM(reservations_payments_types.payment_price) as total_payment')
                )
                ->whereBetween('reservations.reservation_date', [$start, $end])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1, 13, 12, 14, 15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })
                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->groupBy('name')
                ->orderBy('total_payment', 'DESC')
                ->get();

            $sourcePaymentLabels = [];
            $sourcePaymentData   = [];
            $sourcePaymentColors = [];
            $googlePayment = 0;

            foreach ($sourcesPayment as $sourcePayment) {
                $paymentType = $sourcePayment->payment_type_id;
                $payment = $sourcePayment->total_payment;
                $eurTotal = 0;

                if ($paymentType == 5 || $paymentType == 9 || $paymentType == 10) {
                    $eurTotal += $payment / $euro_satis;
                } elseif ($paymentType == 6 || $paymentType == 11 || $paymentType == 13 || $paymentType == 15) {
                    $eurTotal += $payment;
                } elseif ($paymentType == 7 || $paymentType == 12) {
                    $eurTotal += $payment * $euro_usd_satis;
                }

                if ($sourcePayment->name === 'Google') {
                    $googlePayment += $eurTotal;
                } else {
                    array_push($sourcePaymentLabels, $sourcePayment->name);
                    array_push($sourcePaymentData, $eurTotal);
                    $sourcePaymentColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                }
            }

            if ($googlePayment > 0) {
                if ($user->hasRole('Sales Admin')) {
                }else{
                    $sourcePaymentLabels[] = 'GOOGLE';
                    $sourcePaymentData[] = $googlePayment;
                    $sourcePaymentColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                }
            }


            $sourcesPaymentGoogle = DB::table('sources')
                ->leftJoin('reservations', 'sources.id', '=', 'reservations.source_id')
                ->leftJoin('reservations_payments_types', 'reservations.id', '=', 'reservations_payments_types.reservation_id')
                ->leftJoin('payment_types', 'reservations_payments_types.payment_type_id', '=', 'payment_types.id')
                ->select(DB::raw("'Google' as source_name"), 'payment_types.type_name', DB::raw('SUM(reservations_payments_types.payment_price) as total_payment'))
                ->whereIn('sources.id', [12, 13, 14, 15])
                ->whereBetween('reservations.reservation_date', [$start, $end])
                ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [1,13,12,14,15]);
                    });
                })
                ->when($user->hasRole('Sales Admin'), function ($query) {
                    $query->where(function ($query) {
                        $query->whereIn('reservations.source_id', [3]);
                    });
                })
                ->when(!empty($selectedSources), function ($query) use ($selectedSources) {
                    $query->whereIn('reservations.source_id', $selectedSources);
                }, function ($query) {
                    $query->whereNotNull('reservations.source_id');
                })

                ->when(!empty($selectedSales), function ($query) use ($selectedSales) {
                    $query->whereIn('reservations.sales_person_name', $selectedSales);
                })
                ->groupBy('source_name', 'payment_types.type_name')
                ->get();

            $data = array(
                'payments_customer_count'  => $payments_customer_count,
                'hotelComissionsCount'     => $hotelComissionsCount,
                'guideComissionsCount'     => $guideComissionsCount,
                'hotelComissions'          => $hotelComissions,
                'guideComissions'          => $guideComissions,
                'hotelComissionLabels'     => $hotelComissionLabels,
                'hotelComissionData'       => $hotelComissionData,
                'hotelComissionColors'     => $hotelComissionColors,
                'guideComissionLabels'     => $guideComissionLabels,
                'guideComissionData'       => $guideComissionData,
                'guideComissionColors'     => $guideComissionColors,
                'reservationByDateCount'   => $reservationByDateCount,
                'paxByDateCount'           => $paxByDateCount,
                'sourcesByDateLabels'      => $sourcesByDateLabels,
                'sourcesByDateData'        => $sourcesByDateData,
                'sourcesByDateColors'      => $sourcesByDateColors,
                'sourcesAllByDate'         => $sourcesAllByDate,
                'all_paymentLabels'        => $all_paymentLabels,
                'all_paymentData'          => $all_paymentData,
                'all_paymentColors'        => $all_paymentColors,
                'salesPersons'             => $salesPersons,
                'salesPersonLabels'        => $salesPersonLabels,
                'salesPersonData'          => $salesPersonData,
                'salesPersonColors'        => $salesPersonColors,
                'therapistLabels'          => $therapistLabels,
                'therapistData'            => $therapistData,
                'therapistColors'          => $therapistColors,
                'serviceLabels'            => $serviceLabels,
                'serviceData'              => $serviceData,
                'serviceColors'            => $serviceColors,
                'sourceLabels'             => $sourceLabels,
                'sourceData'               => $sourceData,
                'sourceColors'             => $sourceColors,
                'therapistAll'             => $therapistAll,
                'serviceAll'               => $serviceAll,
                'reservationsAll'          => $reservationsAll,
                'sourcesAll'               => $sourcesAll,
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
                'start'                    => $start,
                'end'                      => $end,
                'sourcesSelect'            => $sourcesSelect,
                'selectedSources'          => $selectedSources,
                'subSourceCount'           => $subSourceCount,
                'subSourcePax'             => $subSourcePax,
                'googleSources'            => $googleSources,
                'googleSourceLabels'       => $googleSourceLabels,
                'googleSourceData'         => $googleSourceData,
                'googleSourceColors'       => $googleSourceColors,
                'subSourcesCount'          => $subSourcesCount,
                'salesSelect'              => $salesSelect,
                'byCountry'                => $byCountry,
                'byCountryLabels'          => $byCountryLabels,
                'byCountryData'            => $byCountryData,
                'byCountryColors'          => $byCountryColors,
                'sourcesPayment'           => $sourcesPayment,
                'sourcesPaymentGoogle'     => $sourcesPaymentGoogle,
                'sourcePaymentLabels'      =>$sourcePaymentLabels,
                'sourcePaymentData'        =>$sourcePaymentData,
                'sourcePaymentColors'      =>$sourcePaymentColors,
                'googlePayment'            =>$googlePayment,
                'hotelistanVPEuro'         =>$hotelistanVPEuro,
                'hotelistanVPUsd'          =>$hotelistanVPUsd,
                'hotelistanVPTl'           =>$hotelistanVPTl,
                'hotelistanVPGbp'          =>$hotelistanVPGbp,
            );

            if ($user->hasRole('Performance Marketing Admin')) {
                return view('admin.reports.reservation_report_pm')->with($data);
            }elseif ($user->hasRole('Sales Admin')) {
                return view('admin.reports.reservation_report_sales_admin')->with($data);
            }
             else {
                return view('admin.reports.reservation_report')->with($data);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function sourceReport(Request $request)
    {
        $user = auth()->user();
        $data = Source::select("sources.*", \DB::raw("(SELECT count(*) FROM reservations a WHERE a.source_id = sources.id) as aCount"))
            ->leftJoin('reservations', 'reservations.source_id', '=', 'sources.id')
            ->when($user->hasRole('Performance Marketing Admin'), function ($query) {
                $query->where(function ($query) {
                    $query->where('reservations.source_id', '=', 1)
                        ->orWhere('reservations.source_id', '=', 12);
                });
            })
            ->groupBy('sources.id')
            ->get();
        return json_encode($data);
    }

    public function therapistReport(Request $request)
    {
        try {

            $data = Therapist::select("therapists.*", \DB::raw("(SELECT sum(piece) FROM reservations_therapists a WHERE a.therapist_id = therapists.id) as aCount"))->get();

            return json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function comissionReport(Request $request)
    {
        try {
            $start = $request->input('startDate');
            $end = $request->input('endDate');

            $hotelComissions = ReservationComission::select('hotels.*', DB::raw('hotel_id, sum(comission_price) as totalPrice'))
                ->leftJoin('hotels', 'reservations_comissions.hotel_id', '=', 'hotels.id')
                ->whereBetween('reservations_comissions.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->whereNull('reservations_comissions.guide_id')
                ->where('reservations_comissions.comission_price', '!=', NULL)
                ->groupBy('hotel_id')
                ->get();

            $guideComissions = ReservationComission::select('guides.*', DB::raw('guide_id, sum(comission_price) as totalPrice'))
                ->leftJoin('guides', 'reservations_comissions.guide_id', '=', 'guides.id')
                ->whereBetween('reservations_comissions.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->whereNull('reservations_comissions.hotel_id')
                ->where('reservations_comissions.comission_price', '!=', NULL)
                ->groupBy('guide_id')
                ->get();

            $hotelComissionLabels = [];
            $hotelComissionData = [];
            $hotelComissionColors = [];

            foreach ($hotelComissions as $hotelComission) {
                array_push($hotelComissionLabels, $hotelComission->name);
                array_push($hotelComissionData, $hotelComission->totalPrice);
                $hotelComissionColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            }

            $guideComissionLabels = [];
            $guideComissionData = [];
            $guideComissionColors = [];

            foreach ($guideComissions as $guideComission) {
                array_push($guideComissionLabels, $guideComission->name);
                array_push($guideComissionData, $guideComission->totalPrice);
                $guideComissionColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            }

            $data = array(
                'hotelComissions' => $hotelComissions,
                'guideComissions' => $guideComissions,
                'start' => $start,
                'end' => $end,
                'hotelComissionLabels' => $hotelComissionLabels,
                'hotelComissionData' => $hotelComissionData,
                'hotelComissionColors' => $hotelComissionColors,
                'guideComissionLabels' => $guideComissionLabels,
                'guideComissionData' => $guideComissionData,
                'guideComissionColors' => $guideComissionColors,
            );

            return view('admin.reports.comission_report')->with($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function serviceReport(Request $request)
    {
        $data = Service::select("services.name", \DB::raw("(SELECT count(*) FROM reservations_services a WHERE a.service_id = services.id) as aCount"))->get();

        return json_encode($data);
    }

    public function paymentReport(Request $request)
    {
        try {

            $start = $request->input('startDate');
            $end = $request->input('endDate');

            $cashTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '5')
                ->whereBetween('reservations_payments_types.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->sum("payment_price");

            $cashEur = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '6')
                ->whereBetween('reservations_payments_types.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->sum("payment_price");

            $cashUsd = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '7')
                ->whereBetween('reservations_payments_types.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->sum("payment_price");

            $cashPound = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '8')
                ->whereBetween('reservations_payments_types.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->sum("payment_price");

            $ykbTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '9')
                ->whereBetween('reservations_payments_types.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->sum("payment_price");

            $ziraatTl = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '10')
                ->whereBetween('reservations_payments_types.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->sum("payment_price");

            $ziraatEuro = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '11')
                ->whereBetween('reservations_payments_types.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->sum("payment_price");

            $ziraatDolar = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '12')
                ->whereBetween('reservations_payments_types.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->sum("payment_price");

            $viatorEuro = ReservationPaymentType::where('reservations_payments_types.payment_type_id', '13')
                ->whereBetween('reservations_payments_types.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->sum("payment_price");

            $all_payments = ReservationPaymentType::select('payment_types.*', DB::raw('payment_type_id, sum(payment_price) as totalPrice'))
                ->leftJoin('payment_types', 'reservations_payments_types.payment_type_id', '=', 'payment_types.id')
                ->whereBetween('reservations_payments_types.created_at', [date('Y-m-d', strtotime($start)) . " 00:00:00", date('Y-m-d', strtotime($end)) . " 23:59:59"])
                ->groupBy('payment_type_id')
                ->get();

            $all_paymentLabels = [];
            $all_paymentData = [];
            $all_paymentColors = [];
            foreach ($all_payments as $all_payment) {
                array_push($all_paymentLabels, $all_payment->type_name);
                array_push($all_paymentData, $all_payment->totalPrice);
                $all_paymentColors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            }
            $totalData = array(
                'all_paymentLabels' => $all_paymentLabels,
                'all_paymentData' => $all_paymentData,
                'all_paymentColors' => $all_paymentColors,
                'cashTl' => $cashTl,
                'cashEur' => $cashEur,
                'cashUsd' => $cashUsd,
                'cashPound' => $cashPound,
                'ykbTl' => $ykbTl,
                'ziraatTl' => $ziraatTl,
                'ziraatEuro' => $ziraatEuro,
                'ziraatDolar' => $ziraatDolar,
                'viatorEuro' => $viatorEuro,
                'start' => $start,
                'end' => $end
            );

            return view('admin.reports.payment_report')->with($totalData);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
