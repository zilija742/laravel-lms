@extends('frontend.layouts.app'.config('theme_layout'))
@push('after-styles')
    <style>
        .couse-pagination li.active {
            color: #333333!important;
            font-weight: 700;
        }
        .page-link {
            position: relative;
            display: block;
            padding: .5rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #c7c7c7;
            background-color: white;
            border: none;
        }
        .page-item.active .page-link {
            z-index: 1;
            color: #333333;
            background-color:white;
            border:none;

        }
        ul.pagination{
            display: inline;
            text-align: center;
        }
    </style>
@endpush
@section('content')

	<!-- Start of breadcrumb section
		============================================= -->
		<section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
			<div class="blakish-overlay"></div>
			<div class="container">
				<div class="page-breadcrumb-content text-center">
					<div class="page-breadcrumb-title">
						<h2 class="breadcrumb-head black bold">{{env('APP_NAME')}} <span>@lang('labels.frontend.company.title')</span></h2>
					</div>
				</div>
			</div>
		</section>
	<!-- End of breadcrumb section
		============================================= -->



	<!-- Start of teacher section
		============================================= -->
		<section id="teacher-page" class="teacher-page-section">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<div class="teachers-archive">
							<div class="row">
                                @if(count($companies) > 0)
                                @foreach($companies as $item)
									<div class="col-md-4">
										<div class="best-course-pic-text relative-position">
											<div class="best-course-pic relative-position"
												 @if($item->picture != "") style="background-image: url('{{asset('storage/uploads/'.$item->picture)}}')" @endif>
												<div class="course-details-btn">
													<a href="{{route('companies.show',['id'=>$item->id])}}">@lang('labels.frontend.company.company_detail')
														<i class="fas fa-arrow-right"></i></a>
												</div>
												<div class="blakish-overlay"></div>
											</div>
											<div class="best-course-text">
												<div class="course-title mb20 headline relative-position">
													<h3>
														<a href="{{route('companies.show',['id'=>$item->id])}}">{{$item->name}}</a>
													</h3>
												</div>
											</div>
										</div>
									</div>
                                @endforeach
                                @else
                                    <h4>@lang('lables.general.no_data_available')</h4>
                                @endif


							</div>
							<div class="couse-pagination text-center ul-li">
                                {{ $companies->links() }}
							</div>

						</div>
					</div>
					@include('frontend.layouts.partials.right-sidebar')
				</div>
			</div>
		</section>
	<!-- End of teacher section
		============================================= -->



@endsection