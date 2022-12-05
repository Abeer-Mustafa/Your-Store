
<p> {{ __('dashboard.User Info') }}: </p>
<div style="margin-top:10px;"  class="box">
	<div class="box-body">
        <table class="table table-bordered table-hover textCenter" id="records_table">
            <thead >
                <tr>
                    <th class="textCenter" width="10%">{{ __('dashboard.Image') }}</th>
                    <th class="textCenter" width="5%">{{ __('dashboard.ID') }}</th>
                    <th class="textCenter" width="10%">{{ __('dashboard.Full Name') }}</th>
                    <th class="textCenter" width="20%">{{ __('dashboard.Email') }}</th>
                    <th class="textCenter" width="10%">{{ __('dashboard.Phone') }}</th>
                    <th class="textCenter" width="10%">{{ __('dashboard.Country') }}</th>
                    <th class="textCenter" width="10%">{{ __('dashboard.State') }}</th>
                    <th class="textCenter" width="10%">{{ __('dashboard.City') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="textCenter">
                        @if($user->image)
                            <img src="{{ URL::to('/storage') }}/images/users/{{$user->image}}" width='70' class='img-thumbnail' />
                        @else
                            <img src="{{ URL::to('/front') }}/image/catalog/default_user.png" width='70' class='img-thumbnail' />
                        @endif
                    </td>
                    <td class="textCenter">{{ $user->id }}</td>
                    <td class="textCenter">{{ $user->name }}</td>
                    <td class="textCenter">{{ $user->email }}</td>
                    <td class="textCenter">{{ $user->phone }}</td>
                    <td class="textCenter">{{ $user->country }}</td>
                    <td class="textCenter">{{ $user->state }}</td>
                    <td class="textCenter">{{ $user->city }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>