<li class="{{ isActiveRoute('back.faq.*', 'mm-active') }}">
    <a href="#" aria-expanded="false"><i class="fa fa-question"></i> <span class="nav-label">FAQ</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        @include('admin.module.faq.questions::back.includes.package_navigation')
        @include('admin.module.faq.tags::back.includes.package_navigation')
    </ul>
</li>
