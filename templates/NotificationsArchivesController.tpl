<script>
	jQuery("#select_all").click(function() {

		jQuery(':checkbox').each(function() {
			if (this.checked == true) {
				this.checked = false;
			} else {
				this.checked = true;
			}
		});

	});
</script>

<section id="module-notifications">
	<header>
		<h1>{@notifications.archives}</h1>
	</header>

	<div class="content">
		<nav id="cssmenu-notifications" class="cssmenu cssmenu-group">
			<ul>
				<li>
					<a href="{U_NOTIFICATIONS}" class="cssmenu-title"><i class="fa fa-bell" aria-hidden="true"></i> {@notifications.my_notifications} ({NOTIFICATIONS_NUMBER})</a>
				</li>
				<li>
					<a href="{U_ARCHIVES}" class="cssmenu-title"><i class="fa fa-archive" aria-hidden="true"></i> {@notifications.archives} ({ARCHIVES_NUMBER})</a>
				</li>
				<li>
					<a href="{U_SETTINGS}" class="cssmenu-title"><i class="fa fa-cog" aria-hidden="true"></i> {@notifications.settings}</a>
				</li>
			</ul>
		</nav>
		# IF C_NO_NOTIFICATION #
		<span class="message-helper notice">{@notifications.you_do_not_have}</span>
		# ELSE #
		<form name="form_action" action="{U_FORM}" method="POST">
			# START notifications #
			<div class="notifications">
				<div class="notifications-toolbar">
					<span class="notifications-date">{notifications.DATE}</span>
					<input type="checkbox" name="id[]" value="{notifications.ID}" />
				</div>
				# IF notifications.C_AVATAR #
				<img class="notifications-img" src="{notifications.U_AVATAR}" alt="{notifications.USERNAME}" title="{notifications.USERNAME}" />
				# ENDIF #
				<p>{notifications.MESSAGE}</p>
			</div>
			# END notifications #

			# INCLUDE PAGINATION #
			<input type="hidden" name="token" value="{TOKEN}">
			<button type="button" id="select_all" style="float:right;">{@notifications.select_all}</button>
			<button type="submit" name="deleted" value="true" style="float:right;" data-confirmation="{@notifications.delete.confirmation}">{@notifications.delete}</button>

		</form>

		# END IF #

	</div>
	<footer></footer>
</section>