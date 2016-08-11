@extends('layouts.app')

@section('title', trans('app.AdminSection') )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">{{ trans('app.Users') }}</div>

		@include('pages.admin.menu')

		<div class="panel-body">

		<div class="table-responsive">
			<table class="table table-condensed table-bordered table-responsive" id="ldapusers">
				<thead>
					<td>name</td>
					<td>mail</td>
					<td>title</td>
					<td>department</td>
					<td>telephonenumber</td>
					<td>homephone</td>
					<td>mobile</td>
					{{-- <td>accountexpires</td>
					<td>badpasswordtime</td>
					<td>badpwdcount</td>
					<td>cn</td>
					<td>codepage</td>
					<td>countrycode</td>
					<td>department</td>
					<td>displayname</td>
					<td>distinguishedname</td>
					<td>dscorepropagationdata</td>
					<td>givenname</td>
					<td>instancetype</td>
					<td>lastlogoff</td>
					<td>lastlogon</td>
					<td>lastlogontimestamp</td>
					<td>logoncount</td>
					<td>mail</td>
					<td>mstsexpiredate</td>
					<td>mstslicenseversion</td>
					<td>mstsmanagingls</td>
					<td>name</td>
					<td>objectcategory</td>
					<td>objectclass</td>
					<td>objectguid</td>
					<td>objectsid</td>
					<td>primarygroupid</td>
					<td>pwdlastset</td>
					<td>samaccountname</td>
					<td>samaccounttype</td>
					<td>telephonenumber</td>
					<td>useraccountcontrol</td>
					<td>userprincipalname</td>
					<td>usnchanged</td>
					<td>usncreated</td>
					<td>whenchanged</td>
					<td>whencreated</td> --}}
				</thead>
					@foreach($ldapusers as $ldapuser)
						<tr>
							<td>{{ $ldapuser->name[0] }}</td>
							<td>{{ $ldapuser->mail[0] }}</td>
							<td>{{ $ldapuser->title[0] }}</td>
							<td>{{ $ldapuser->department[0] }}</td>
							<td>{{ $ldapuser->telephonenumber[0] }}</td>
							<td>{{ $ldapuser->homephone[0] }}</td>
							<td>{{ $ldapuser->mobile[0] }}</td>
							{{-- <td>{{ $ldapuser->accountexpires[0] }}</td>
							<td>{{ $ldapuser->badpasswordtime[0] }}</td>
							<td>{{ $ldapuser->badpwdcount[0] }}</td>
							<td>{{ $ldapuser->cn[0] }}</td>
							<td>{{ $ldapuser->codepage[0] }}</td>
							<td>{{ $ldapuser->countrycode[0] }}</td>
							<td>{{ $ldapuser->department[0] }}</td>
							<td>{{ $ldapuser->displayname[0] }}</td>
							<td>{{ $ldapuser->distinguishedname[0] }}</td>
							<td>{{ $ldapuser->dscorepropagationdata[0] }}</td>
							<td>{{ $ldapuser->givenname[0] }}</td>
							<td>{{ $ldapuser->instancetype[0] }}</td>
							<td>{{ $ldapuser->lastlogoff[0] }}</td>
							<td>{{ $ldapuser->lastlogon[0] }}</td>
							<td>{{ $ldapuser->lastlogontimestamp[0] }}</td>
							<td>{{ $ldapuser->logoncount[0] }}</td>
							<td>{{ $ldapuser->mail[0] }}</td>
							<td>{{ $ldapuser->mstsexpiredate[0] }}</td>
							<td>{{ $ldapuser->mstslicenseversion[0] }}</td>
							<td>{{ $ldapuser->mstsmanagingls[0] }}</td>
							<td>{{ $ldapuser->name[0] }}</td>
							<td>{{ $ldapuser->objectcategory[0] }}</td>
							<td>{{ $ldapuser->objectclass[0] }}</td>
							<td>{{ $ldapuser->objectguid[0] }}</td>
							<td>{{ $ldapuser->objectsid[0] }}</td>
							<td>{{ $ldapuser->primarygroupid[0] }}</td>
							<td>{{ $ldapuser->pwdlastset[0] }}</td>
							<td>{{ $ldapuser->samaccountname[0] }}</td>
							<td>{{ $ldapuser->samaccounttype[0] }}</td>
							<td>{{ $ldapuser->telephonenumber[0] }}</td>
							<td>{{ $ldapuser->useraccountcontrol[0] }}</td>
							<td>{{ $ldapuser->userprincipalname[0] }}</td>
							<td>{{ $ldapuser->usnchanged[0] }}</td>
							<td>{{ $ldapuser->usncreated[0] }}</td>
							<td>{{ $ldapuser->whenchanged[0] }}</td>
							<td>{{ $ldapuser->whencreated[0] }}</td> --}}
						</tr>
					@endforeach
			</table>
		</div>
	</div>

	</div>
@endsection



@section('footer')
	<script>

		$('#ldapusers').DataTable({
			responsive: true,
			paging:   	false,
			ordering: 	true,
			info:     	true,
			searching: 	true,
			select: 	true
		});

	</script>
@endsection