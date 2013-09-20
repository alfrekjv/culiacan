<?php $view->extend('::admin.html.php'); ?>

<?php $view['slots']->start('include_css') ?>
<?php $view['slots']->stop(); ?>

<?php $view['slots']->start('include_js_body') ?>
<script src="<?= $view['assets']->getUrl('js/libs/jquery.validationEngine-en.js') ?>"></script>
<script src="<?= $view['assets']->getUrl('js/libs/jquery.validationEngine.js') ?>"></script>
<script src="<?= $view['assets']->getUrl('js/libs/jquery.dataTables.min.js') ?>"></script>
<script src="<?= $view['assets']->getUrl('admin/js/manage-user.js') ?>"></script>
<?php $view['slots']->stop(); ?>


<?=$view->render('AdminModule:index:sidebar.html.php');?>

<div id="content" class="admin-user inner">
    
    <div id="content-header">
        <h1>Usuarios</h1>
    </div>
    
    <div id="breadcrumb" class="breadcrumb">
        <a href="<?=$view['router']->generate('Admin_Index');?>" class="tip-bottom" data-original-title="Ir al Administrador"><i class="icon-home icon-white"></i> Admin</a> >>
        Usuarios
    </div>

    <div class="sub-menu">
        <ul>
            <li><a href="<?=$view['router']->generate('Admin_User_Create');?>">Crear Usuario</a></li>
        </ul>
    </div>

    <div class="container-fluid">
        
        <div class="row-fluid">
            <div class="span12">

                <div class="widget-box">
                    
                    <div class="widget-title">
                        <h5><i class="icon-align-justify icon-white"></i>Usuarios Registrados</h5>
                    </div>
                    
                    <div class="widget-content">
                        <table class="table table-bordered table-striped data-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(empty($users)): ?>
                                <tr><td colspan="5"><p>No users found</p></td></tr>
                            <?php else: ?>
                                <?php foreach($users as $user): ?>
                                <tr>
                                    <td><?=$user->getID();?></td>
                                    <td><?=$view->escape($user->getFullName());?></td>
                                    <td><?=$view->escape($user->getEmail());?></td>
                                    <td class="actions">
                                        <a href="<?=$view['router']->generate('Admin_User_Edit', array('id' => $user->getID()));?>" title="Edit User" class="btn"><i class="icon-edit"></i> Edit</a>
                                        <a href="<?=$view['router']->generate('Admin_User_Delete', array('id' => $user->getID()));?>" title="Delete User" class="btn deleteUser" data-userid="<?=$user->getID();?>"><i class="icon-remove"></i> Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            
                            </tbody>
                        
                        </table>
                    </div>
                </div>
                <!-- /.widget-box -->
            </div>
        </div>
    </div>
</div>