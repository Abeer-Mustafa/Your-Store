@include('admin.layouts.head')
@include('admin.layouts.header')
@include('admin.layouts.sidebar')

<input type="hidden" id="dashboard" name="dashboard" value="{{ route('dashboard') }}">
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <h1>
            @yield('subTitle')
        </h1>
        <ol class="breadcrumb">
            <li>@yield('subTitle')</li>
            <li class="active"><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>{{ __('dashboard.Dashboard') }}</a></li>
        </ol>
    </section>

    <!-- Errors | Session | Content -->
    <section class="content">
        @if(count($errors) > 0)
            <div class="text-center alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden=true>&times;</button>
                <strong>{{ __('dashboard.Whoops') }}</strong> {{ __('dashboard.There were some problems with your input.') }}<br><br>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session()->has('success'))
            <div class="text-center alert alert-success" style="margin-bottom: 2%;">
              <i class="fa fa-check-circle"></i>
              {{session()->get('success')}}
              <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif
        
        @yield('content')
    </section>
</div>



@include('admin.layouts.footer')
