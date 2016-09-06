@if (Auth::user())

<nav class="navbar navbar-default navbar-fixed-bottom">
	<div class="container">
		<div class="col-md-8 col-md-offset-2">

			<ul class="nav navbar-nav">
				<li>
					<p class="navbar-text small">
						<i class="fa fa-fw fa-btn fa-copyright"></i>
						<span class="text-muted">Идея и разработка - Антон Хамаев</span>
					</p>
				</li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li>
					<p class="navbar-text small navbar-right">
						<i class="fa fa-fw fa-btn fa-at"></i>
						По всем вопросам пишите <a href="mailto:anton@grandbaikal.ru?subject=About IT Helpdesk">anton@grandbaikal.ru</a>
					</p>
				</li>
			</ul>

		</div>
	</div>
</nav>

@endif