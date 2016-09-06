@if (Auth::user())

<nav class="navbar navbar-default navbar-fixed-bottom">
	<div class="container text-center">
		<ul class="nav navbar-nav">
			<li>
				<a href="mailto:anton@grandbaikal.ru?subject=About IT Helpdesk">
					{{-- <i class="fa fa-fw fa-btn fa-copyright"></i> --}}
					<i class="fa fa-fw fa-btn fa-at"></i>
					По всем вопросам пишите <strong><ins>anton@grandbaikal.ru</ins></strong>
					{{-- <span class="text-muted small text-center">Идея и разработка - Антон Хамаев</span> --}}
				</a>
			</li>
		</ul>
		{{-- <span class="text-muted small">&copy / &reg;</span>
		<span class="text-muted small">@</p> --}}
		{{-- <p class="text-muted small text-center">&copy Идея и разработка - Антон Хамаев</p> --}}
		{{-- <p class="text-muted small text-center">По всем вопросам пишите <a href="mailto:">anton@grandbaikal.ru</a></p> --}}
	</div>
</nav>

@endif