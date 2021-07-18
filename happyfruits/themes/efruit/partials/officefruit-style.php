<style>
    .c-home__cat-feat {
        text-align: center;
        padding: 0 0 12px;
    }

    @media all and (min-width:672px) {
        .c-home__cat-feat h2 {
            margin-bottom: 36px;
        }
    }
    .o-layout {
        list-style: none;
        margin: 0 0 0 -24px;
        padding: 0;
    }

    .o-layout__item {
        display: inline-block;
        padding-left: 24px;
        vertical-align: top;
        width: 100%;
        margin-bottom: 24px;
    }

    .o-layout--tiny {
        margin-left: -6px;
    }

    .o-layout--tiny > .o-layout__item {
        padding-left: 6px;
    }

    .o-layout--small {
        margin-left: -18px;
    }

    .o-layout--small > .o-layout__item {
        padding-left: 18px;
    }

    .o-layout--large {
        margin-left: -36px;
    }

    .o-layout--large > .o-layout__item {
        padding-left: 36px;
    }

    .o-layout--huge {
        margin-left: -96px;
    }

    .o-layout--huge > .o-layout__item {
        padding-left: 96px;
    }

    .o-layout--flush {
        margin-left: 0;
    }

    @media all and (min-width: 672px) {
        .o-layout--large > .o-layout__item {
            margin-bottom: 36px;
        }
    }

    .o-layout--flush > .o-layout__item {
        padding-left: 0;
        margin-bottom: 0;
    }

    .o-wrapper {
        max-width: 1436px;
        margin: 0 auto;
        padding: 0 24px;
    }

    @media all and (min-width: 960px) {
        .o-wrapper {
            padding: 0 48px;
        }
    }

    .o-wrapper--medium {
        max-width: 1216px;
    }

    .c-christmas-closures .c-cms-content form input[type=submit], .o-btn, .post-password-form input[type=submit] {
        display: inline-block;
        vertical-align: middle;
        font: inherit;
        text-align: center;
        margin: 0;
        cursor: pointer;
        overflow: visible;
        background-color: #61B63F;
        border: none;
        border-radius: 2px;

    }

    .c-christmas-closures .c-cms-content form input:active[type=submit], .c-christmas-closures .c-cms-content form input:focus[type=submit], .c-christmas-closures .c-cms-content form input:hover[type=submit], .c-christmas-closures .c-cms-content form input[type=submit], .o-btn, .o-btn:active, .o-btn:focus, .o-btn:hover, .post-password-form input:active[type=submit], .post-password-form input:focus[type=submit], .post-password-form input:hover[type=submit], .post-password-form input[type=submit] {
        text-decoration: none;
        color: #FFF;
    }

    .c-christmas-closures .c-cms-content form input[type=submit]::-moz-focus-inner, .o-btn::-moz-focus-inner, .post-password-form input[type=submit]::-moz-focus-inner {
        border: 0;
        padding: 0;
    }

    .c-christmas-closures .c-cms-content form input[type=submit], .o-btn, .post-password-form input[type=submit] {
        font-family: "American Typewriter", sans-serif;
        font-size: 16px;
        line-height: 1;
        padding: 10px 32px;
        transition: .25s;
    }

    .c-christmas-closures .c-cms-content form input:hover[type=submit], .o-btn:hover, .post-password-form input:hover[type=submit] {
        background: #4e9232;
    }

    .o-btn--red {
        background-color: #e32e00;
    }

    .o-btn--red:hover {
        background: #b62500;
    }

    .flexbox .o-module {
        display: -ms-flexbox;
        display: flex;
        overflow: hidden;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    }

    .flexbox .o-module__item {
        display: -ms-flexbox;
        display: flex;
    }

    .flexbox .o-module__content {
        -ms-flex: 1;
        flex: 1;
    }

    .flexbox .o-module__content--bottom {
        -ms-flex-item-align: end;
        align-self: flex-end;
    }

    .o-aspect {
        position: relative;
    }

    .o-aspect:before {
        content: '';
        float: left;
        width: 0;
        height: 0;
        padding-bottom: 100%;
    }

    .o-aspect--69:before {
        padding-bottom: 69%;
    }

    .o-aspect--4by3:before {
        padding-bottom: 66.667%;
    }

    .o-aspect--16by9:before {
        padding-bottom: 56.25%;
    }

    .o-fluid-object, .o-fluid-object--69 {
        padding-bottom: 69%;
    }

    .o-aspect > * {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .o-fluid-object {
        position: relative;
        width: 100%;
        margin-bottom: 24px;
    }

    .o-fluid-object iframe, .o-fluid-object object {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .o-fluid-object--56 {
        padding-bottom: 56%;
    }

    .o-fluid-object--4by3 {
        padding-bottom: 66.667%;
    }

    .o-fluid-object--16by9 {
        padding-bottom: 56.25%;
    }

    .o-color--bread .c-content, .o-color--ra-office-bread .c-content {
        background: #fdfcfa;
    }

    .o-color--bread .c-footer__products_intro h2, .o-color--bread a, .o-color--bread h1, .o-color--bread h2, .o-color--bread h3, .o-color--bread h4, .o-color--ra-office-bread .c-footer__products_intro h2, .o-color--ra-office-bread a, .o-color--ra-office-bread h1, .o-color--ra-office-bread h2, .o-color--ra-office-bread h3, .o-color--ra-office-bread h4 {
        color: #966014;
    }

    .c-christmas-closures .c-cms-content form .o-color--bread input[type=submit], .c-christmas-closures .c-cms-content form .o-color--ra-office-bread input[type=submit], .o-color--bread .c-christmas-closures .c-cms-content form input[type=submit], .o-color--bread .o-btn, .o-color--bread .post-password-form input[type=submit], .o-color--ra-office-bread .c-christmas-closures .c-cms-content form input[type=submit], .o-color--ra-office-bread .o-btn, .o-color--ra-office-bread .post-password-form input[type=submit], .post-password-form .o-color--bread input[type=submit], .post-password-form .o-color--ra-office-bread input[type=submit] {
        background: #966014;
        color: #fff;
    }

    .c-christmas-closures .c-cms-content form .o-color--bread input:hover[type=submit], .c-christmas-closures .c-cms-content form .o-color--ra-office-bread input:hover[type=submit], .o-color--bread .c-christmas-closures .c-cms-content form input:hover[type=submit], .o-color--bread .o-btn:hover, .o-color--bread .post-password-form input:hover[type=submit], .o-color--ra-office-bread .c-christmas-closures .c-cms-content form input:hover[type=submit], .o-color--ra-office-bread .o-btn:hover, .o-color--ra-office-bread .post-password-form input:hover[type=submit], .post-password-form .o-color--bread input:hover[type=submit], .post-password-form .o-color--ra-office-bread input:hover[type=submit] {
        background: #784d10;
    }

    .o-color--bread .c-cat-nav, .o-color--ra-office-bread .c-cat-nav {
        background: #966014;
    }

    .o-color--bread .c-cat-nav .menu-level-0 > a, .o-color--ra-office-bread .c-cat-nav .menu-level-0 > a {
        color: #cbb08a;
    }

    .o-color--bread .c-cat-nav .menu-level-0 > a.active, .o-color--bread .c-cat-nav .menu-level-0 > a:hover, .o-color--ra-office-bread .c-cat-nav .menu-level-0 > a.active, .o-color--ra-office-bread .c-cat-nav .menu-level-0 > a:hover {
        color: #fff;
    }

    .o-color--bread .c-cat-nav .menu-level-2.current-item > a, .o-color--bread .c-cat-nav-mobile li.current-item > a, .o-color--bread .o-color-100, .o-color--ra-office-bread .c-cat-nav .menu-level-2.current-item > a, .o-color--ra-office-bread .c-cat-nav-mobile li.current-item > a, .o-color--ra-office-bread .o-color-100 {
        color: #966014;
    }

    .o-color--bread .c-cat-nav .menu-level-0 > .sub-menu, .o-color--ra-office-bread .c-cat-nav .menu-level-0 > .sub-menu {
        background: #f5efe8;
    }

    .o-color--bread .c-cat-nav .menu-level-1 > a:after, .o-color--ra-office-bread .c-cat-nav .menu-level-1 > a:after {
        background: #966014;
    }

    .o-color--bread .c-cat-nav-mobile li, .o-color--bread .c-cat-nav-mobile li .toggle-arrow, .o-color--ra-office-bread .c-cat-nav-mobile li, .o-color--ra-office-bread .c-cat-nav-mobile li .toggle-arrow {
        border-color: #d5bfa1;
    }

    .o-color--bread .c-dot-list li:before, .o-color--ra-office-bread .c-dot-list li:before {
        background: #966014;
    }

    .o-color--bread .c-form__submit .ajax-loader, .o-color--ra-office-bread .c-form__submit .ajax-loader {
        background-color: #966014;
    }

    .o-color--bread .o-color-10, .o-color--ra-office-bread .o-color-10 {
        color: #f5efe8;
    }

    .o-color--bread .o-color-bgt-20, .o-color--ra-office-bread .o-color-bgt-20 {
        background: rgba(150, 96, 20, .2);
    }

    .o-color--bread .o-color-bgt-50, .o-color--ra-office-bread .o-color-bgt-50 {
        background: rgba(150, 96, 20, .5);
    }

    .o-color--bread .o-color-bg-100, .o-color--ra-office-bread .o-color-bg-100 {
        background: #966014;
    }

    .o-color--bread .o-color-bg-85, .o-color--ra-office-bread .o-color-bg-85 {
        background: #a67837;
    }

    .o-color--bread .o-color-bg-75, .o-color--ra-office-bread .o-color-bg-75 {
        background: #b0884f;
    }

    .o-color--bread .o-color-bg-25, .o-color--ra-office-bread .o-color-bg-25 {
        background: #e5d7c4;
    }

    .o-color--bread .o-color-bg-15, .o-color--ra-office-bread .o-color-bg-15 {
        background: #efe7dc;
    }

    .o-color--bread .o-color-bg-10, .o-color--ra-office-bread .o-color-bg-10 {
        background: #f5efe8;
    }

    .o-color--bread .o-color-bg-5, .o-color--ra-office-bread .o-color-bg-5 {
        background: #faf7f3;
    }

    .o-color--fruit .c-content, .o-color--ra-office-fruit .c-content {
        background: #fefafb;
    }

    .o-color--fruit .c-footer__products_intro h2, .o-color--fruit a, .o-color--fruit h1, .o-color--fruit h2, .o-color--fruit h3, .o-color--fruit h4, .o-color--ra-office-fruit .c-footer__products_intro h2, .o-color--ra-office-fruit a, .o-color--ra-office-fruit h1, .o-color--ra-office-fruit h2, .o-color--ra-office-fruit h3, .o-color--ra-office-fruit h4 {
        color: #df0f36;
    }

    .c-christmas-closures .c-cms-content form .o-color--fruit input[type=submit], .c-christmas-closures .c-cms-content form .o-color--ra-office-fruit input[type=submit], .o-color--fruit .c-christmas-closures .c-cms-content form input[type=submit], .o-color--fruit .o-btn, .o-color--fruit .post-password-form input[type=submit], .o-color--ra-office-fruit .c-christmas-closures .c-cms-content form input[type=submit], .o-color--ra-office-fruit .o-btn, .o-color--ra-office-fruit .post-password-form input[type=submit], .post-password-form .o-color--fruit input[type=submit], .post-password-form .o-color--ra-office-fruit input[type=submit] {
        background: #df0f36;
        color: #fff;
    }

    .c-christmas-closures .c-cms-content form .o-color--fruit input:hover[type=submit], .c-christmas-closures .c-cms-content form .o-color--ra-office-fruit input:hover[type=submit], .o-color--fruit .c-christmas-closures .c-cms-content form input:hover[type=submit], .o-color--fruit .o-btn:hover, .o-color--fruit .post-password-form input:hover[type=submit], .o-color--ra-office-fruit .c-christmas-closures .c-cms-content form input:hover[type=submit], .o-color--ra-office-fruit .o-btn:hover, .o-color--ra-office-fruit .post-password-form input:hover[type=submit], .post-password-form .o-color--fruit input:hover[type=submit], .post-password-form .o-color--ra-office-fruit input:hover[type=submit] {
        background: #b20c2b;
    }

    .o-color--fruit .c-cat-nav, .o-color--ra-office-fruit .c-cat-nav {
        background: #df0f36;
    }

    .o-color--fruit .c-cat-nav .menu-level-0 > a, .o-color--ra-office-fruit .c-cat-nav .menu-level-0 > a {
        color: #ef879b;
    }

    .o-color--fruit .c-cat-nav .menu-level-0 > a.active, .o-color--fruit .c-cat-nav .menu-level-0 > a:hover, .o-color--ra-office-fruit .c-cat-nav .menu-level-0 > a.active, .o-color--ra-office-fruit .c-cat-nav .menu-level-0 > a:hover {
        color: #fff;
    }

    .o-color--fruit .c-cat-nav .menu-level-2.current-item > a, .o-color--fruit .c-cat-nav-mobile li.current-item > a, .o-color--fruit .o-color-100, .o-color--ra-office-fruit .c-cat-nav .menu-level-2.current-item > a, .o-color--ra-office-fruit .c-cat-nav-mobile li.current-item > a, .o-color--ra-office-fruit .o-color-100 {
        color: #DF0F36;
    }

    .o-color--fruit .c-cat-nav .menu-level-0 > .sub-menu, .o-color--ra-office-fruit .c-cat-nav .menu-level-0 > .sub-menu {
        background: #fce7eb;
    }

    .o-color--fruit .c-cat-nav .menu-level-1 > a:after, .o-color--ra-office-fruit .c-cat-nav .menu-level-1 > a:after {
        background: #DF0F36;
    }

    .o-color--fruit .c-cat-nav-mobile li, .o-color--fruit .c-cat-nav-mobile li .toggle-arrow, .o-color--ra-office-fruit .c-cat-nav-mobile li, .o-color--ra-office-fruit .c-cat-nav-mobile li .toggle-arrow {
        border-color: #f29faf;
    }

    .o-color--fruit .c-dot-list li:before, .o-color--ra-office-fruit .c-dot-list li:before {
        background: #DF0F36;
    }

    .o-color--fruit .c-form__submit .ajax-loader, .o-color--ra-office-fruit .c-form__submit .ajax-loader {
        background-color: #DF0F36;
    }

    .o-color--fruit .o-color-10, .o-color--ra-office-fruit .o-color-10 {
        color: #fce7eb;
    }

    .o-color--fruit .o-color-bgt-20, .o-color--ra-office-fruit .o-color-bgt-20 {
        background: rgba(223, 15, 54, .2);
    }

    .o-color--fruit .o-color-bgt-50, .o-color--ra-office-fruit .o-color-bgt-50 {
        background: rgba(223, 15, 54, .5);
    }

    .o-color--fruit .o-color-bg-100, .o-color--ra-office-fruit .o-color-bg-100 {
        background: #DF0F36;
    }

    .o-color--fruit .o-color-bg-85, .o-color--ra-office-fruit .o-color-bg-85 {
        background: #e43354;
    }

    .o-color--fruit .o-color-bg-75, .o-color--ra-office-fruit .o-color-bg-75 {
        background: #e74b68;
    }

    .o-color--fruit .o-color-bg-25, .o-color--ra-office-fruit .o-color-bg-25 {
        background: #f7c3cd;
    }

    .o-color--fruit .o-color-bg-15, .o-color--ra-office-fruit .o-color-bg-15 {
        background: #fadbe1;
    }

    .o-color--fruit .o-color-bg-10, .o-color--ra-office-fruit .o-color-bg-10 {
        background: #fce7eb;
    }

    .o-color--fruit .o-color-bg-5, .o-color--ra-office-fruit .o-color-bg-5 {
        background: #fdf3f5;
    }

    .o-color--milk .c-content, .o-color--ra-office-milk .c-content {
        background: #fcfefe;
    }

    .o-color--milk .c-footer__products_intro h2, .o-color--milk a, .o-color--milk h1, .o-color--milk h2, .o-color--milk h3, .o-color--milk h4, .o-color--ra-office-milk .c-footer__products_intro h2, .o-color--ra-office-milk a, .o-color--ra-office-milk h1, .o-color--ra-office-milk h2, .o-color--ra-office-milk h3, .o-color--ra-office-milk h4 {
        color: #56bae5;
    }

    .c-christmas-closures .c-cms-content form .o-color--milk input[type=submit], .c-christmas-closures .c-cms-content form .o-color--ra-office-milk input[type=submit], .o-color--milk .c-christmas-closures .c-cms-content form input[type=submit], .o-color--milk .o-btn, .o-color--milk .post-password-form input[type=submit], .o-color--ra-office-milk .c-christmas-closures .c-cms-content form input[type=submit], .o-color--ra-office-milk .o-btn, .o-color--ra-office-milk .post-password-form input[type=submit], .post-password-form .o-color--milk input[type=submit], .post-password-form .o-color--ra-office-milk input[type=submit] {
        background: linear-gradient(to right, #58B720 70%, #6ef065 100%);
        color: #fff;
    }

    .c-christmas-closures .c-cms-content form .o-color--milk input:hover[type=submit], .c-christmas-closures .c-cms-content form .o-color--ra-office-milk input:hover[type=submit], .o-color--milk .c-christmas-closures .c-cms-content form input:hover[type=submit], .o-color--milk .o-btn:hover, .o-color--milk .post-password-form input:hover[type=submit], .o-color--ra-office-milk .c-christmas-closures .c-cms-content form input:hover[type=submit], .o-color--ra-office-milk .o-btn:hover, .o-color--ra-office-milk .post-password-form input:hover[type=submit], .post-password-form .o-color--milk input:hover[type=submit], .post-password-form .o-color--ra-office-milk input:hover[type=submit] {
        background-position: 0 0;
    }

    .o-color--milk .c-cat-nav, .o-color--ra-office-milk .c-cat-nav {
        background: #56bae5;
    }

    .o-color--milk .c-cat-nav .menu-level-0 > a, .o-color--ra-office-milk .c-cat-nav .menu-level-0 > a {
        color: #abddf2;
    }

    .o-color--milk .c-cat-nav .menu-level-0 > a.active, .o-color--milk .c-cat-nav .menu-level-0 > a:hover, .o-color--ra-office-milk .c-cat-nav .menu-level-0 > a.active, .o-color--ra-office-milk .c-cat-nav .menu-level-0 > a:hover {
        color: #fff;
    }

    .o-color--milk .c-cat-nav .menu-level-2.current-item > a, .o-color--milk .c-cat-nav-mobile li.current-item > a, .o-color--milk .o-color-100, .o-color--ra-office-milk .c-cat-nav .menu-level-2.current-item > a, .o-color--ra-office-milk .c-cat-nav-mobile li.current-item > a, .o-color--ra-office-milk .o-color-100 {
        color: #56BAE5;
    }

    .o-color--milk .c-cat-nav .menu-level-0 > .sub-menu, .o-color--ra-office-milk .c-cat-nav .menu-level-0 > .sub-menu {
        background: #eef8fc;
    }

    .o-color--milk .c-cat-nav .menu-level-1 > a:after, .o-color--ra-office-milk .c-cat-nav .menu-level-1 > a:after {
        background: #56BAE5;
    }

    .o-color--milk .c-cat-nav-mobile li, .o-color--milk .c-cat-nav-mobile li .toggle-arrow, .o-color--ra-office-milk .c-cat-nav-mobile li, .o-color--ra-office-milk .c-cat-nav-mobile li .toggle-arrow {
        border-color: #bbe3f5;
    }

    .o-color--milk .c-dot-list li:before, .o-color--ra-office-milk .c-dot-list li:before {
        background: #56BAE5;
    }

    .o-color--milk .c-form__submit .ajax-loader, .o-color--ra-office-milk .c-form__submit .ajax-loader {
        background-color: #56BAE5;
    }

    .o-color--milk .o-color-10, .o-color--ra-office-milk .o-color-10 {
        color: #eef8fc;
    }

    .o-color--milk .o-color-bgt-20, .o-color--ra-office-milk .o-color-bgt-20 {
        background: rgba(86, 186, 229, .2);
    }

    .o-color--milk .o-color-bgt-50, .o-color--ra-office-milk .o-color-bgt-50 {
        background: rgba(86, 186, 229, .5);
    }

    .o-color--milk .o-color-bg-100, .o-color--ra-office-milk .o-color-bg-100 {
        background: #56BAE5;
    }

    .o-color--milk .o-color-bg-85, .o-color--ra-office-milk .o-color-bg-85 {
        background: #6fc4e9;
    }

    .o-color--milk .o-color-bg-75, .o-color--ra-office-milk .o-color-bg-75 {
        background: #80cbec;
    }

    .o-color--milk .o-color-bg-25, .o-color--ra-office-milk .o-color-bg-25 {
        background: #d5eef9;
    }

    .o-color--milk .o-color-bg-15, .o-color--ra-office-milk .o-color-bg-15 {
        background: #e6f5fb;
    }

    .o-color--milk .o-color-bg-10, .o-color--ra-office-milk .o-color-bg-10 {
        background: #eef8fc;
    }

    .o-color--milk .o-color-bg-5, .o-color--ra-office-milk .o-color-bg-5 {
        background: #f7fcfe;
    }

    .o-color--coffee .c-content, .o-color--ra-office-coffee .c-content {
        background: #fefdfb;
    }

    .o-color--coffee .c-footer__products_intro h2, .o-color--coffee a, .o-color--coffee h1, .o-color--coffee h2, .o-color--coffee h3, .o-color--coffee h4, .o-color--ra-office-coffee .c-footer__products_intro h2, .o-color--ra-office-coffee a, .o-color--ra-office-coffee h1, .o-color--ra-office-coffee h2, .o-color--ra-office-coffee h3, .o-color--ra-office-coffee h4 {
        color: #be9546;
    }

    .c-christmas-closures .c-cms-content form .o-color--coffee input[type=submit], .c-christmas-closures .c-cms-content form .o-color--ra-office-coffee input[type=submit], .o-color--coffee .c-christmas-closures .c-cms-content form input[type=submit], .o-color--coffee .o-btn, .o-color--coffee .post-password-form input[type=submit], .o-color--ra-office-coffee .c-christmas-closures .c-cms-content form input[type=submit], .o-color--ra-office-coffee .o-btn, .o-color--ra-office-coffee .post-password-form input[type=submit], .post-password-form .o-color--coffee input[type=submit], .post-password-form .o-color--ra-office-coffee input[type=submit] {
        background: #be9546;
        color: #fff;
    }

    .c-christmas-closures .c-cms-content form .o-color--coffee input:hover[type=submit], .c-christmas-closures .c-cms-content form .o-color--ra-office-coffee input:hover[type=submit], .o-color--coffee .c-christmas-closures .c-cms-content form input:hover[type=submit], .o-color--coffee .o-btn:hover, .o-color--coffee .post-password-form input:hover[type=submit], .o-color--ra-office-coffee .c-christmas-closures .c-cms-content form input:hover[type=submit], .o-color--ra-office-coffee .o-btn:hover, .o-color--ra-office-coffee .post-password-form input:hover[type=submit], .post-password-form .o-color--coffee input:hover[type=submit], .post-password-form .o-color--ra-office-coffee input:hover[type=submit] {
        background: #987738;
    }

    .o-color--coffee .c-cat-nav, .o-color--ra-office-coffee .c-cat-nav {
        background: #be9546;
    }

    .o-color--coffee .c-cat-nav .menu-level-0 > a, .o-color--ra-office-coffee .c-cat-nav .menu-level-0 > a {
        color: #dfcaa3;
    }

    .o-color--coffee .c-cat-nav .menu-level-0 > a.active, .o-color--coffee .c-cat-nav .menu-level-0 > a:hover, .o-color--ra-office-coffee .c-cat-nav .menu-level-0 > a.active, .o-color--ra-office-coffee .c-cat-nav .menu-level-0 > a:hover {
        color: #fff;
    }

    .o-color--coffee .c-cat-nav .menu-level-2.current-item > a, .o-color--coffee .c-cat-nav-mobile li.current-item > a, .o-color--coffee .o-color-100, .o-color--ra-office-coffee .c-cat-nav .menu-level-2.current-item > a, .o-color--ra-office-coffee .c-cat-nav-mobile li.current-item > a, .o-color--ra-office-coffee .o-color-100 {
        color: #BE9546;
    }

    .o-color--coffee .c-cat-nav .menu-level-0 > .sub-menu, .o-color--ra-office-coffee .c-cat-nav .menu-level-0 > .sub-menu {
        background: #f9f4ed;
    }

    .o-color--coffee .c-cat-nav .menu-level-1 > a:after, .o-color--ra-office-coffee .c-cat-nav .menu-level-1 > a:after {
        background: #BE9546;
    }

    .o-color--coffee .c-cat-nav-mobile li, .o-color--coffee .c-cat-nav-mobile li .toggle-arrow, .o-color--ra-office-coffee .c-cat-nav-mobile li, .o-color--ra-office-coffee .c-cat-nav-mobile li .toggle-arrow {
        border-color: #e5d5b5;
    }

    .o-color--coffee .c-dot-list li:before, .o-color--ra-office-coffee .c-dot-list li:before {
        background: #BE9546;
    }

    .o-color--coffee .c-form__submit .ajax-loader, .o-color--ra-office-coffee .c-form__submit .ajax-loader {
        background-color: #BE9546;
    }

    .o-color--coffee .o-color-10, .o-color--ra-office-coffee .o-color-10 {
        color: #f9f4ed;
    }

    .o-color--coffee .o-color-bgt-20, .o-color--ra-office-coffee .o-color-bgt-20 {
        background: rgba(190, 149, 70, .2);
    }

    .o-color--coffee .o-color-bgt-50, .o-color--ra-office-coffee .o-color-bgt-50 {
        background: rgba(190, 149, 70, .5);
    }

    .o-color--coffee .o-color-bg-100, .o-color--ra-office-coffee .o-color-bg-100 {
        background: #BE9546;
    }

    .o-color--coffee .o-color-bg-85, .o-color--ra-office-coffee .o-color-bg-85 {
        background: #c8a562;
    }

    .o-color--coffee .o-color-bg-75, .o-color--ra-office-coffee .o-color-bg-75 {
        background: #ceb074;
    }

    .o-color--coffee .o-color-bg-25, .o-color--ra-office-coffee .o-color-bg-25 {
        background: #efe5d1;
    }

    .o-color--coffee .o-color-bg-15, .o-color--ra-office-coffee .o-color-bg-15 {
        background: #f5efe3;
    }

    .o-color--coffee .o-color-bg-10, .o-color--ra-office-coffee .o-color-bg-10 {
        background: #f9f4ed;
    }

    .o-color--coffee .o-color-bg-5, .o-color--ra-office-coffee .o-color-bg-5 {
        background: #fcfaf6;
    }

    .o-color--cakes .c-content, .o-color--ra-office-cakes .c-content {
        background: #fdfbfd;
    }

    .o-color--cakes .c-footer__products_intro h2, .o-color--cakes a, .o-color--cakes h1, .o-color--cakes h2, .o-color--cakes h3, .o-color--cakes h4, .o-color--ra-office-cakes .c-footer__products_intro h2, .o-color--ra-office-cakes a, .o-color--ra-office-cakes h1, .o-color--ra-office-cakes h2, .o-color--ra-office-cakes h3, .o-color--ra-office-cakes h4 {
        color: #a927aa;
    }

    .c-christmas-closures .c-cms-content form .o-color--cakes input[type=submit], .c-christmas-closures .c-cms-content form .o-color--ra-office-cakes input[type=submit], .o-color--cakes .c-christmas-closures .c-cms-content form input[type=submit], .o-color--cakes .o-btn, .o-color--cakes .post-password-form input[type=submit], .o-color--ra-office-cakes .c-christmas-closures .c-cms-content form input[type=submit], .o-color--ra-office-cakes .o-btn, .o-color--ra-office-cakes .post-password-form input[type=submit], .post-password-form .o-color--cakes input[type=submit], .post-password-form .o-color--ra-office-cakes input[type=submit] {
        background: #a927aa;
        color: #fff;
    }

    .c-christmas-closures .c-cms-content form .o-color--cakes input:hover[type=submit], .c-christmas-closures .c-cms-content form .o-color--ra-office-cakes input:hover[type=submit], .o-color--cakes .c-christmas-closures .c-cms-content form input:hover[type=submit], .o-color--cakes .o-btn:hover, .o-color--cakes .post-password-form input:hover[type=submit], .o-color--ra-office-cakes .c-christmas-closures .c-cms-content form input:hover[type=submit], .o-color--ra-office-cakes .o-btn:hover, .o-color--ra-office-cakes .post-password-form input:hover[type=submit], .post-password-form .o-color--cakes input:hover[type=submit], .post-password-form .o-color--ra-office-cakes input:hover[type=submit] {
        background: #871f88;
    }

    .o-color--cakes .c-cat-nav, .o-color--ra-office-cakes .c-cat-nav {
        background: #a927aa;
    }

    .o-color--cakes .c-cat-nav .menu-level-0 > a, .o-color--ra-office-cakes .c-cat-nav .menu-level-0 > a {
        color: #d493d5;
    }

    .o-color--cakes .c-cat-nav .menu-level-0 > a.active, .o-color--cakes .c-cat-nav .menu-level-0 > a:hover, .o-color--ra-office-cakes .c-cat-nav .menu-level-0 > a.active, .o-color--ra-office-cakes .c-cat-nav .menu-level-0 > a:hover {
        color: #fff;
    }

    .o-color--cakes .c-cat-nav .menu-level-2.current-item > a, .o-color--cakes .c-cat-nav-mobile li.current-item > a, .o-color--cakes .o-color-100, .o-color--ra-office-cakes .c-cat-nav .menu-level-2.current-item > a, .o-color--ra-office-cakes .c-cat-nav-mobile li.current-item > a, .o-color--ra-office-cakes .o-color-100 {
        color: #A927AA;
    }

    .o-color--cakes .c-cat-nav .menu-level-0 > .sub-menu, .o-color--ra-office-cakes .c-cat-nav .menu-level-0 > .sub-menu {
        background: #f6e9f7;
    }

    .o-color--cakes .c-cat-nav .menu-level-1 > a:after, .o-color--ra-office-cakes .c-cat-nav .menu-level-1 > a:after {
        background: #A927AA;
    }

    .o-color--cakes .c-cat-nav-mobile li, .o-color--cakes .c-cat-nav-mobile li .toggle-arrow, .o-color--ra-office-cakes .c-cat-nav-mobile li, .o-color--ra-office-cakes .c-cat-nav-mobile li .toggle-arrow {
        border-color: #dda9dd;
    }

    .o-color--cakes .c-dot-list li:before, .o-color--ra-office-cakes .c-dot-list li:before {
        background: #A927AA;
    }

    .o-color--cakes .c-form__submit .ajax-loader, .o-color--ra-office-cakes .c-form__submit .ajax-loader {
        background-color: #A927AA;
    }

    .o-color--cakes .o-color-10, .o-color--ra-office-cakes .o-color-10 {
        color: #f6e9f7;
    }

    .o-color--cakes .o-color-bgt-20, .o-color--ra-office-cakes .o-color-bgt-20 {
        background: rgba(169, 39, 170, .2);
    }

    .o-color--cakes .o-color-bgt-50, .o-color--ra-office-cakes .o-color-bgt-50 {
        background: rgba(169, 39, 170, .5);
    }

    .o-color--cakes .o-color-bg-100, .o-color--ra-office-cakes .o-color-bg-100 {
        background: #A927AA;
    }

    .o-color--cakes .o-color-bg-85, .o-color--ra-office-cakes .o-color-bg-85 {
        background: #b647b7;
    }

    .o-color--cakes .o-color-bg-75, .o-color--ra-office-cakes .o-color-bg-75 {
        background: #bf5dbf;
    }

    .o-color--cakes .o-color-bg-25, .o-color--ra-office-cakes .o-color-bg-25 {
        background: #eac9ea;
    }

    .o-color--cakes .o-color-bg-15, .o-color--ra-office-cakes .o-color-bg-15 {
        background: #f2dff2;
    }

    .o-color--cakes .o-color-bg-10, .o-color--ra-office-cakes .o-color-bg-10 {
        background: #f6e9f7;
    }

    .o-color--cakes .o-color-bg-5, .o-color--ra-office-cakes .o-color-bg-5 {
        background: #fbf4fb;
    }

    .o-color--catering .c-content, .o-color--ra-office-catering .c-content {
        background: #fdfdfd;
    }

    .o-color--catering .c-footer__products_intro h2, .o-color--catering a, .o-color--catering h1, .o-color--catering h2, .o-color--catering h3, .o-color--catering h4, .o-color--ra-office-catering .c-footer__products_intro h2, .o-color--ra-office-catering a, .o-color--ra-office-catering h1, .o-color--ra-office-catering h2, .o-color--ra-office-catering h3, .o-color--ra-office-catering h4 {
        color: #9b9a9a;
    }

    .c-christmas-closures .c-cms-content form .o-color--catering input[type=submit], .c-christmas-closures .c-cms-content form .o-color--ra-office-catering input[type=submit], .o-color--catering .c-christmas-closures .c-cms-content form input[type=submit], .o-color--catering .o-btn, .o-color--catering .post-password-form input[type=submit], .o-color--ra-office-catering .c-christmas-closures .c-cms-content form input[type=submit], .o-color--ra-office-catering .o-btn, .o-color--ra-office-catering .post-password-form input[type=submit], .post-password-form .o-color--catering input[type=submit], .post-password-form .o-color--ra-office-catering input[type=submit] {
        background: #9b9a9a;
        color: #fff;
    }

    .c-christmas-closures .c-cms-content form .o-color--catering input:hover[type=submit], .c-christmas-closures .c-cms-content form .o-color--ra-office-catering input:hover[type=submit], .o-color--catering .c-christmas-closures .c-cms-content form input:hover[type=submit], .o-color--catering .o-btn:hover, .o-color--catering .post-password-form input:hover[type=submit], .o-color--ra-office-catering .c-christmas-closures .c-cms-content form input:hover[type=submit], .o-color--ra-office-catering .o-btn:hover, .o-color--ra-office-catering .post-password-form input:hover[type=submit], .post-password-form .o-color--catering input:hover[type=submit], .post-password-form .o-color--ra-office-catering input:hover[type=submit] {
        background: #7c7b7b;
    }

    .o-color--catering .c-cat-nav, .o-color--ra-office-catering .c-cat-nav {
        background: #9b9a9a;
    }

    .o-color--catering .c-cat-nav .menu-level-0 > a, .o-color--ra-office-catering .c-cat-nav .menu-level-0 > a {
        color: #fff;
    }

    .o-color--catering .c-cat-nav .menu-level-0 > a.active, .o-color--catering .c-cat-nav .menu-level-0 > a:hover, .o-color--ra-office-catering .c-cat-nav .menu-level-0 > a.active, .o-color--ra-office-catering .c-cat-nav .menu-level-0 > a:hover {
        color: #cdcdcd;
    }

    .o-color--catering .c-cat-nav .menu-level-2.current-item > a, .o-color--catering .c-cat-nav-mobile li.current-item > a, .o-color--catering .o-color-100, .o-color--ra-office-catering .c-cat-nav .menu-level-2.current-item > a, .o-color--ra-office-catering .c-cat-nav-mobile li.current-item > a, .o-color--ra-office-catering .o-color-100 {
        color: #9B9A9A;
    }

    .o-color--catering .c-cat-nav .menu-level-0 > .sub-menu, .o-color--ra-office-catering .c-cat-nav .menu-level-0 > .sub-menu {
        background: white;
    }

    .o-color--catering .c-cat-nav .menu-level-1 > a:after, .o-color--ra-office-catering .c-cat-nav .menu-level-1 > a:after {
        background: #9B9A9A;
    }

    .o-color--catering .c-cat-nav-mobile li, .o-color--catering .c-cat-nav-mobile li .toggle-arrow, .o-color--ra-office-catering .c-cat-nav-mobile li, .o-color--ra-office-catering .c-cat-nav-mobile li .toggle-arrow {
        border-color: #d7d7d7;
    }

    .o-color--catering .c-dot-list li:before, .o-color--ra-office-catering .c-dot-list li:before {
        background: #9B9A9A;
    }

    .o-color--catering .c-form__submit .ajax-loader, .o-color--ra-office-catering .c-form__submit .ajax-loader {
        background-color: #9B9A9A;
    }

    .o-color--catering .o-color-10, .o-color--ra-office-catering .o-color-10 {
        color: #f5f5f5;
    }

    .o-color--catering .o-color-bgt-20, .o-color--ra-office-catering .o-color-bgt-20 {
        background: rgba(155, 154, 154, .2);
    }

    .o-color--catering .o-color-bgt-50, .o-color--ra-office-catering .o-color-bgt-50 {
        background: rgba(155, 154, 154, .5);
    }

    .o-color--catering .o-color-bg-100, .o-color--ra-office-catering .o-color-bg-100 {
        background: #9B9A9A;
    }

    .o-color--catering .o-color-bg-85, .o-color--ra-office-catering .o-color-bg-85 {
        background: #aaa9a9;
    }

    .o-color--catering .o-color-bg-75, .o-color--ra-office-catering .o-color-bg-75 {
        background: #b4b3b3;
    }

    .o-color--catering .o-color-bg-25, .o-color--ra-office-catering .o-color-bg-25 {
        background: #e6e6e6;
    }

    .o-color--catering .o-color-bg-15, .o-color--ra-office-catering .o-color-bg-15 {
        background: #f0f0f0;
    }

    .o-color--catering .o-color-bg-10, .o-color--ra-office-catering .o-color-bg-10 {
        background: #f5f5f5;
    }

    .o-color--catering .o-color-bg-5, .o-color--ra-office-catering .o-color-bg-5 {
        background: #fafafa;
    }

    .c-cat-nav {
        text-align: center;
        padding: 13px 0;
        box-shadow: 0 0 10px -4px #000;
        font-size: 18px;
        line-height: 1.5;
        color: #58595B;
        position: relative;
        z-index: 250;
    }

    @media all and (min-width: 800px) {
        .c-cat-nav {
            display: block;
        }
    }

    .c-cat-nav ul {
        margin: 0;
        padding: 0;
        vertical-align: top;
    }

    .c-cat-nav ul li {
        display: inline-block;
        vertical-align: top;
    }

    .c-cat-nav ul li a {
        text-decoration: none;
        display: inline-block;
        transition: .25s;
    }

    .c-cat-nav .menu-level-0 > a {
        padding: 0 15px;
        color: #8a8b8d;
        font-family: "American Typewriter",sans-serif;
        font-size: 18px;
    }

    .c-cat-nav .menu-level-0 > a:hover {
        color: #6D6E71;
    }

    @media all and (min-width: 672px) {
        .c-cat-nav .menu-level-0 > a {
            padding: 6px 18px;
        }
    }

    .c-cat-nav .menu-level-0.current-item > a {
        color: #fff;
    }

    .c-cat-nav .menu-level-0 > .sub-menu {
        display: none;
        position: absolute;
        top: 65px;
        left: 0;
        z-index: 10;
        width: 100%;
        padding: 0 !important;
        background: #FFF;
        overflow: hidden;
    }

    .c-cat-nav .menu-level-0 > .sub-menu.left-align {
        overflow: visible;
        text-align: left;
        left: auto;
    }
    .c-cat-nav .menu-level-0 > .sub-menu.left-align:before {
        position: absolute;
        top: 0;
        z-index: -1;
        width: 200%;
        height: 100%;
        left: -100%;
        content: "";
        padding: 0 !important;
        background: #FFF;
        overflow: hidden;
        box-shadow: 0 5px 12px -10px #000;
    }

    .c-category-list.fixed .c-cat-nav .menu-level-0 > .sub-menu {
        top: 49px;
    }

    @media all and (min-width: 1850px) {
        .c-cat-nav .menu-level-0 > .sub-menu {
            padding: 0 8% !important;
        }
    }

    .c-cat-nav .menu-level-1 {
        display: inline-block;
        width: 100%;
        padding: 12px;
    }

    @media all and (min-width: 672px) {
        .c-cat-nav .menu-level-1 {
            max-width: 49%;
            width: auto;
        }
    }

    @media all and (min-width: 960px) {
        .c-cat-nav .menu-level-1 {
            max-width: 19%;
            width: auto;
        }
    }

    .c-cat-nav .menu-level-1 > a {
        font-size: 17px;
        line-height: 1.2;
        padding-bottom: 2px;
        margin-bottom: 6px;
        color: #221F20;
        width: 100%;
        position: relative;
    }

    .c-cat-nav-mobile, .c-cat-nav-mobile ul {
        margin: 0;
        padding: 0;
    }

    .c-cat-nav .menu-level-1 > a:after {
        content: ' ';
        display: block;
        width: 100%;
        height: 1px;
        max-width: 164px;
        position: absolute;
        bottom: -4px;
        left: 50%;
        -ms-transform: translateX(-50%);
        transform: translateX(-50%);
        background: #61B63F;
    }

    .c-product-land__seasonal-fruits li span, .c-range-block__image {
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
    }

    .c-cat-nav .menu-level-1 > a:hover {
        color: #58595B;
    }

    .c-cat-nav .menu-level-1 > .sub-menu {
        display: block !important;
        max-height: 1000px !important;
        height: 100% !important;
        opacity: 1 !important;
    }

    .c-cat-nav .menu-level-2 {
        display: block;
    }

    .c-cat-nav .menu-level-2.current-item > a {
        color: #61B63F;
    }

    .c-cat-nav .menu-level-2 > a {
        font-size: 16px;
        line-height: 1.2;
        color: #58595B;
        font-family: "American Typewriter",sans-serif;
    }

    .c-cat-nav .menu-level-2 > a:hover {
        color: #000;
    }

    @media all and (min-width: 800px) {
        .c-cat-nav-mobile {
            display: none;
        }
    }

    .c-cat-nav-mobile li {
        list-style: none;
        text-align: center;
    }

    .c-cat-nav-mobile li a {
        text-decoration: none;
        font-size: 13px;
        line-height: 1.5;
        display: block;
        margin: 6px 0;
        color: #58595B;
    }

    .c-cat-nav-mobile li.current-item > a {
        color: #61B63F;
    }

    .c-cat-nav-mobile > li {
        position: relative;
        border-bottom: 1px solid;
        padding: 6px 24px;
    }

    .c-cat-nav-mobile > li > a {
        font-size: 16px;
        line-height: 1.3;
    }

    .c-product-land__seasonal-fruits li span, .c-range-block__bread-range, .c-range-block__buy, .c-range-block__cakes-range li, .c-range-block__coffee-range span, .c-range-block__milk-range {
        font-family: "OpenSans SemiBold", sans-serif;
    }

    .c-cat-nav-mobile > li .sub-menu-open .toggle-arrow {
        -ms-transform: rotate(180deg);
        transform: rotate(180deg);
    }

    .c-cat-nav-mobile > li .toggle-arrow {
        padding: 0;
        position: absolute;
        top: 18px;
        right: 12px;
        border-left: 6px solid transparent !important;
        border-right: 6px solid transparent !important;
        border-top: 6px solid;
        transition: .25s;
    }

    .c-cat-nav-mobile > li ul {
        display: none;
        width: 100% !important;
        padding: 1px;
    }

    .c-product-feat__bg {
        background-size: cover;
        background-repeat: no-repeat;
    }
    .c-product-feat__container {
        display: block;
        width: 100%;
        position: relative;
        overflow: hidden;
        border-radius: 2px;
        padding-bottom: 0;
        text-decoration: none;
        color: #221F20;
    }

    @media all and (min-width:800px) {
        .c-product-feat__container {
            padding-bottom: 63%;
        }
        .c-category-list.fixed{
            position: fixed;
            top: 0;
            z-index: 999;
            width: 100%;
        }
        .c-category-list.fixed .c-cat-nav{
            padding: 5px 0;
        }
        .c-product-feat__container:hover .c-product-feat__bg {
            filter: blur(5px);
            -ms-transform: scale(1.1);
            transform: scale(1.1);
        }

        .c-product-feat__container:hover .c-product-feat__bg-over {
            opacity: 1;
        }

        .c-product-feat__container:hover .c-product-feat__icon {
            opacity: 0;
            transition: .5s;
        }

        .c-product-feat__container:hover .c-product-feat__content {
            opacity: 1;
            transition: .5s .2s;
            pointer-events: all;
        }

        .c-product-feat--alt .c-product-feat__container:hover .c-product-feat__bg {
            filter: blur(5px);
        }

        .c-product-feat--alt .c-product-feat__container:hover .c-product-feat__bg-over,.c-product-feat--alt .c-product-feat__container:hover .c-product-feat__icon {
            opacity: 1;
        }
    }

    .c-product-feat--alt .c-product-feat__container {
        border-radius: 0;
    }

    .c-product-feat__bg {
        background-position: center;
        height: 130px;
        overflow: hidden;
    }

    @media all and (min-width:800px) {
        .c-product-feat--alt.not-on-large {
            display: none;
        }

        .c-product-feat__bg,.c-product-feat__bg-over {
            position: absolute;
            top: 0;
            left: 0;
            transition: .5s;
            width: 100%;
        }

        .c-product-feat__bg {
            height: 100%;
            padding-top: 0;
            -ms-transform: scale(1.05);
            transform: scale(1.05);
        }
    }

    .c-product-feat__content .o-btn{
        margin-top: 10px;
    }
    @media all and (max-width:799px) {
        .c-product-feat__content .o-btn{
            display:none
        }

    }

    .c-product-feat__bg-over {
        height: 100%;
        -ms-transform: scale(1.05);
        transform: scale(1.05);
        opacity: 0;
    }

    .c-product-feat__icon {
        padding: 24px;
        position: relative;
        z-index: 6;
        transition: .5s .2s;
        margin: auto;
        background-image: url(<?=get_theme_assets_url()?>img/category-middle-bg.png);
        background-size: 100% auto;
        display: table;
        opacity: 0.7;
    }

    .c-product-feat--alt .c-product-feat__icon {
        width: 100%;
        max-width: 156px;
    }

    .c-product-feat__icon img {
        max-width: 110px;
        margin: auto;
    }

    @media all and (min-width:800px) {
        .c-product-feat__icon {
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%,-50%);
            transform: translate(-50%,-50%);
            width: 150px;
            height: 132px;
        }

        .c-product-feat__icon img {
            max-width: 170px;
        }
    }

    .c-product-feat__content {
        width: 100%;
        padding: 12px;
        transition: .5s;
        position: unset;
        -ms-transform: none;
        transform: none;
        z-index: 10;
        color: #000;
    }

    .c-product-feat__content h3, .c-product-feat__icon h3 {
        display: none;
        color: #fff;
        font-weight: 400;
        margin-bottom: 6px;
        font-family: "American Typewriter",sans-serif;
    }

    .c-product-feat__content p {
        font-size: 14px;
        line-height: 1.5;
        margin: 0;
        font-family: "OpenSans Regular",sans-serif;
    }

    @media all and (min-width:800px) {
        .c-product-feat__content {
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%,-50%);
            transform: translate(-50%,-50%);
            color: #fff;
            padding: 24px;
        }

        .c-product-feat__content h3 {
            display: block;
            font-size: 30px;
            line-height: 1;
        }

        .c-product-feat__icon h3 {
            display: table-cell;
            font-size: 20px;
            line-height: 1;
            vertical-align: middle;
        }

        .c-product-feat__content p {
            color: #fff;
        }
    }

    .u-one-whole {
        width: 100%;
    }

    .u-five-tenths,.u-four-eighths,.u-one-half,.u-six-twelfths,.u-three-sixths,.u-two-quarters {
        width: 50%;
    }

    .u-four-twelfths,.u-one-third,.u-three-ninths,.u-two-sixths {
        width: 33.3333333%;
    }

    .u-eight-twelfths,.u-four-sixths,.u-six-ninths,.u-two-thirds {
        width: 66.6666666%;
    }

    .u-one-quarter,.u-three-twelfths,.u-two-eighths {
        width: 25%;
    }

    .u-nine-twelfths,.u-six-eighths,.u-three-quarters {
        width: 75%;
    }

    .u-one-fifth,.u-two-tenths {
        width: 20%;
    }

    .u-four-tenths,.u-two-fifths {
        width: 40%;
    }

    .u-six-tenths,.u-three-fifths {
        width: 60%;
    }

    .u-eight-tenths,.u-four-fifths {
        width: 80%;
    }

    .u-one-sixth,.u-two-twelfths {
        width: 16.6666666%;
    }

    .u-five-sixths,.u-ten-twelfths {
        width: 83.3333333%;
    }

    .u-one-eighth {
        width: 12.5%;
    }

    .u-three-eighths {
        width: 37.5%;
    }

    .u-five-eighths {
        width: 62.5%;
    }

    .u-seven-eighths {
        width: 87.5%;
    }

    .u-one-ninth {
        width: 11.1111111%;
    }

    .u-two-ninths {
        width: 22.2222222%;
    }

    .u-four-ninths {
        width: 44.4444444%;
    }

    .u-five-ninths {
        width: 55.5555555%;
    }

    .u-seven-ninths {
        width: 77.7777777%;
    }

    .u-eight-ninths {
        width: 88.8888888%;
    }

    .u-one-tenth {
        width: 10%;
    }

    .u-three-tenths {
        width: 30%;
    }

    .u-seven-tenths {
        width: 70%;
    }

    .u-nine-tenths {
        width: 90%;
    }

    .u-one-twelfth {
        width: 8.3333333%;
    }

    .u-five-twelfths {
        width: 41.6666666%;
    }

    .u-seven-twelfths {
        width: 58.3333333%;
    }

    .u-eleven-twelfths {
        width: 91.6666666%;
    }

    @media all and (min-width:319px) {
        .u-medium-palm-one-whole {
            width: 100%;
        }

        .u-medium-palm-five-tenths,.u-medium-palm-four-eighths,.u-medium-palm-one-half,.u-medium-palm-six-twelfths,.u-medium-palm-three-sixths,.u-medium-palm-two-quarters {
            width: 50%;
        }

        .u-medium-palm-four-twelfths,.u-medium-palm-one-third,.u-medium-palm-three-ninths,.u-medium-palm-two-sixths {
            width: 33.3333333%;
        }

        .u-medium-palm-eight-twelfths,.u-medium-palm-four-sixths,.u-medium-palm-six-ninths,.u-medium-palm-two-thirds {
            width: 66.6666666%;
        }

        .u-medium-palm-one-quarter,.u-medium-palm-three-twelfths,.u-medium-palm-two-eighths {
            width: 25%;
        }

        .u-medium-palm-nine-twelfths,.u-medium-palm-six-eighths,.u-medium-palm-three-quarters {
            width: 75%;
        }

        .u-medium-palm-one-fifth,.u-medium-palm-two-tenths {
            width: 20%;
        }

        .u-medium-palm-four-tenths,.u-medium-palm-two-fifths {
            width: 40%;
        }

        .u-medium-palm-six-tenths,.u-medium-palm-three-fifths {
            width: 60%;
        }

        .u-medium-palm-eight-tenths,.u-medium-palm-four-fifths {
            width: 80%;
        }

        .u-medium-palm-one-sixth,.u-medium-palm-two-twelfths {
            width: 16.6666666%;
        }

        .u-medium-palm-five-sixths,.u-medium-palm-ten-twelfths {
            width: 83.3333333%;
        }
    }

    @media all and (min-width:459px) {
        .u-wide-palm-one-whole {
            width: 100%;
        }

        .u-wide-palm-five-tenths,.u-wide-palm-four-eighths,.u-wide-palm-one-half,.u-wide-palm-six-twelfths,.u-wide-palm-three-sixths,.u-wide-palm-two-quarters {
            width: 50%;
        }

        .u-wide-palm-four-twelfths,.u-wide-palm-one-third,.u-wide-palm-three-ninths,.u-wide-palm-two-sixths {
            width: 33.3333333%;
        }

        .u-wide-palm-eight-twelfths,.u-wide-palm-four-sixths,.u-wide-palm-six-ninths,.u-wide-palm-two-thirds {
            width: 66.6666666%;
        }

        .u-wide-palm-one-quarter,.u-wide-palm-three-twelfths,.u-wide-palm-two-eighths {
            width: 25%;
        }

        .u-wide-palm-nine-twelfths,.u-wide-palm-six-eighths,.u-wide-palm-three-quarters {
            width: 75%;
        }

        .u-wide-palm-one-fifth,.u-wide-palm-two-tenths {
            width: 20%;
        }

        .u-wide-palm-four-tenths,.u-wide-palm-two-fifths {
            width: 40%;
        }

        .u-wide-palm-six-tenths,.u-wide-palm-three-fifths {
            width: 60%;
        }

        .u-wide-palm-eight-tenths,.u-wide-palm-four-fifths {
            width: 80%;
        }

        .u-wide-palm-one-sixth,.u-wide-palm-two-twelfths {
            width: 16.6666666%;
        }

        .u-wide-palm-five-sixths,.u-wide-palm-ten-twelfths {
            width: 83.3333333%;
        }
    }

    @media all and (min-width:500px) {
        .u-x-wide-palm-one-whole {
            width: 100%;
        }

        .u-x-wide-palm-five-tenths,.u-x-wide-palm-four-eighths,.u-x-wide-palm-one-half,.u-x-wide-palm-six-twelfths,.u-x-wide-palm-three-sixths,.u-x-wide-palm-two-quarters {
            width: 50%;
        }

        .u-x-wide-palm-four-twelfths,.u-x-wide-palm-one-third,.u-x-wide-palm-three-ninths,.u-x-wide-palm-two-sixths {
            width: 33.3333333%;
        }

        .u-x-wide-palm-eight-twelfths,.u-x-wide-palm-four-sixths,.u-x-wide-palm-six-ninths,.u-x-wide-palm-two-thirds {
            width: 66.6666666%;
        }

        .u-x-wide-palm-one-quarter,.u-x-wide-palm-three-twelfths,.u-x-wide-palm-two-eighths {
            width: 25%;
        }

        .u-x-wide-palm-nine-twelfths,.u-x-wide-palm-six-eighths,.u-x-wide-palm-three-quarters {
            width: 75%;
        }

        .u-x-wide-palm-one-fifth,.u-x-wide-palm-two-tenths {
            width: 20%;
        }

        .u-x-wide-palm-four-tenths,.u-x-wide-palm-two-fifths {
            width: 40%;
        }

        .u-x-wide-palm-six-tenths,.u-x-wide-palm-three-fifths {
            width: 60%;
        }

        .u-x-wide-palm-eight-tenths,.u-x-wide-palm-four-fifths {
            width: 80%;
        }

        .u-x-wide-palm-one-sixth,.u-x-wide-palm-two-twelfths {
            width: 16.6666666%;
        }

        .u-x-wide-palm-five-sixths,.u-x-wide-palm-ten-twelfths {
            width: 83.3333333%;
        }
    }

    @media all and (min-width:672px) {
        .u-lap-one-whole {
            width: 100%;
        }

        .u-lap-five-tenths,.u-lap-four-eighths,.u-lap-one-half,.u-lap-six-twelfths,.u-lap-three-sixths,.u-lap-two-quarters {
            width: 50%;
        }

        .u-lap-four-twelfths,.u-lap-one-third,.u-lap-three-ninths,.u-lap-two-sixths {
            width: 33.3333333%;
        }

        .u-lap-eight-twelfths,.u-lap-four-sixths,.u-lap-six-ninths,.u-lap-two-thirds {
            width: 66.6666666%;
        }

        .u-lap-one-quarter,.u-lap-three-twelfths,.u-lap-two-eighths {
            width: 25%;
        }

        .u-lap-nine-twelfths,.u-lap-six-eighths,.u-lap-three-quarters {
            width: 75%;
        }

        .u-lap-one-fifth,.u-lap-two-tenths {
            width: 20%;
        }

        .u-lap-four-tenths,.u-lap-two-fifths {
            width: 40%;
        }

        .u-lap-six-tenths,.u-lap-three-fifths {
            width: 60%;
        }

        .u-lap-eight-tenths,.u-lap-four-fifths {
            width: 80%;
        }

        .u-lap-one-sixth,.u-lap-two-twelfths {
            width: 16.6666666%;
        }

        .u-lap-five-sixths,.u-lap-ten-twelfths {
            width: 83.3333333%;
        }
    }

    @media all and (min-width:800px) {
        .confirmation-popup_content .cross-signup {
            font-size: 25px;
        }

        .u-lap-wide-one-whole {
            width: 100%;
        }

        .u-lap-wide-five-tenths,.u-lap-wide-four-eighths,.u-lap-wide-one-half,.u-lap-wide-six-twelfths,.u-lap-wide-three-sixths,.u-lap-wide-two-quarters {
            width: 50%;
        }

        .u-lap-wide-four-twelfths,.u-lap-wide-one-third,.u-lap-wide-three-ninths,.u-lap-wide-two-sixths {
            width: 33.1%;
        }

        .u-lap-wide-eight-twelfths,.u-lap-wide-four-sixths,.u-lap-wide-six-ninths,.u-lap-wide-two-thirds {
            width: 66.6666666%;
        }

        .u-lap-wide-one-quarter,.u-lap-wide-three-twelfths,.u-lap-wide-two-eighths {
            width: 25%;
        }

        .u-lap-wide-nine-twelfths,.u-lap-wide-six-eighths,.u-lap-wide-three-quarters {
            width: 75%;
        }

        .u-lap-wide-one-fifth,.u-lap-wide-two-tenths {
            width: 20%;
        }

        .u-lap-wide-four-tenths,.u-lap-wide-two-fifths {
            width: 40%;
        }

        .u-lap-wide-six-tenths,.u-lap-wide-three-fifths {
            width: 60%;
        }

        .u-lap-wide-eight-tenths,.u-lap-wide-four-fifths {
            width: 80%;
        }

        .u-lap-wide-one-sixth,.u-lap-wide-two-twelfths {
            width: 16.6666666%;
        }

        .u-lap-wide-five-sixths,.u-lap-wide-ten-twelfths {
            width: 83.3333333%;
        }
    }

    @media all and (min-width:960px) {
        .u-desk-one-whole {
            width: 100%;
        }

        .u-desk-five-tenths,.u-desk-four-eighths,.u-desk-one-half,.u-desk-six-twelfths,.u-desk-three-sixths,.u-desk-two-quarters {
            width: 50%;
        }

        .u-desk-four-twelfths,.u-desk-one-third,.u-desk-three-ninths,.u-desk-two-sixths {
            width: 33.3333333%;
        }

        .u-desk-eight-twelfths,.u-desk-four-sixths,.u-desk-six-ninths,.u-desk-two-thirds {
            width: 66.6666666%;
        }

        .u-desk-one-quarter,.u-desk-three-twelfths,.u-desk-two-eighths {
            width: 25%;
        }

        .u-desk-nine-twelfths,.u-desk-six-eighths,.u-desk-three-quarters {
            width: 75%;
        }

        .u-desk-one-fifth,.u-desk-two-tenths {
            width: 20%;
        }

        .u-desk-four-tenths,.u-desk-two-fifths {
            width: 40%;
        }

        .u-desk-six-tenths,.u-desk-three-fifths {
            width: 60%;
        }

        .u-desk-eight-tenths,.u-desk-four-fifths {
            width: 80%;
        }

        .u-desk-one-sixth,.u-desk-two-twelfths {
            width: 16.6666666%;
        }

        .u-desk-five-sixths,.u-desk-ten-twelfths {
            width: 83.3333333%;
        }
    }

    @media all and (min-width:1250px) {
        .u-wall-one-whole {
            width: 100%;
        }

        .u-wall-five-tenths,.u-wall-four-eighths,.u-wall-one-half,.u-wall-six-twelfths,.u-wall-three-sixths,.u-wall-two-quarters {
            width: 50%;
        }

        .u-wall-four-twelfths,.u-wall-one-third,.u-wall-three-ninths,.u-wall-two-sixths {
            width: 33.3333333%;
        }

        .u-wall-eight-twelfths,.u-wall-four-sixths,.u-wall-six-ninths,.u-wall-two-thirds {
            width: 66.6666666%;
        }

        .u-wall-one-quarter,.u-wall-three-twelfths,.u-wall-two-eighths {
            width: 25%;
        }

        .u-wall-nine-twelfths,.u-wall-six-eighths,.u-wall-three-quarters {
            width: 75%;
        }

        .u-wall-one-fifth,.u-wall-two-tenths {
            width: 20%;
        }

        .u-wall-four-tenths,.u-wall-two-fifths {
            width: 40%;
        }

        .u-wall-six-tenths,.u-wall-three-fifths {
            width: 60%;
        }

        .u-wall-eight-tenths,.u-wall-four-fifths {
            width: 80%;
        }

        .u-wall-one-sixth,.u-wall-two-twelfths {
            width: 16.6666666%;
        }

        .u-wall-five-sixths,.u-wall-ten-twelfths {
            width: 83.3333333%;
        }
    }

    @media all and (min-width:1850px) {
        .u-wall-wide-one-whole {
            width: 100%;
        }

        .u-wall-wide-five-tenths,.u-wall-wide-four-eighths,.u-wall-wide-one-half,.u-wall-wide-six-twelfths,.u-wall-wide-three-sixths,.u-wall-wide-two-quarters {
            width: 50%;
        }

        .u-wall-wide-four-twelfths,.u-wall-wide-one-third,.u-wall-wide-three-ninths,.u-wall-wide-two-sixths {
            width: 33.3333333%;
        }

        .u-wall-wide-eight-twelfths,.u-wall-wide-four-sixths,.u-wall-wide-six-ninths,.u-wall-wide-two-thirds {
            width: 66.6666666%;
        }

        .u-wall-wide-one-quarter,.u-wall-wide-three-twelfths,.u-wall-wide-two-eighths {
            width: 25%;
        }

        .u-wall-wide-nine-twelfths,.u-wall-wide-six-eighths,.u-wall-wide-three-quarters {
            width: 75%;
        }

        .u-wall-wide-one-fifth,.u-wall-wide-two-tenths {
            width: 20%;
        }

        .u-wall-wide-four-tenths,.u-wall-wide-two-fifths {
            width: 40%;
        }

        .u-wall-wide-six-tenths,.u-wall-wide-three-fifths {
            width: 60%;
        }

        .u-wall-wide-eight-tenths,.u-wall-wide-four-fifths {
            width: 80%;
        }

        .u-wall-wide-one-sixth,.u-wall-wide-two-twelfths {
            width: 16.6666666%;
        }

        .u-wall-wide-five-sixths,.u-wall-wide-ten-twelfths {
            width: 83.3333333%;
        }
    }
</style>