<section id="module-notifications">
    <header>
        <h1>{@notifications.config.title}</h1>
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
        
        {@notifications.config.content}

        # INCLUDE FORM #
    </div>

    <footer></footer>
</section>