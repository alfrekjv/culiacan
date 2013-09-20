<div class="breadcrumb">
    <a href="<?=$view['router']->generate('Admin_Index');?>">Admin</a> >>
    Settings >>
    User
</div>

<aside class="sub-menu">
    <ul>
        <li><a href="<?=$view['router']->generate('User_Account');?>"><i class="icon-user icon-white"></i> View Account</a></li>
        <li><a href="<?=$view['router']->generate('User_Edit_Account');?>"><i class="icon-pencil icon-white"></i> Edit Account</a></li>
        <li><a href="<?=$view['router']->generate('User_Edit_Password');?>"><i class="icon-cog icon-white"></i> Edit Password</a></li>
    </ul>
</aside>