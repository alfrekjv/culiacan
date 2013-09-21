<?php $view->extend('::admin.html.php'); ?>
<?php $view['slots']->start('include_css') ?>
<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('admin/css/catalogos/marcas/index.css') ?>" />
<?php $view['slots']->stop(); ?>

<div class="inner">

    <div class="breadcrumb">
        <a href="<?=$view['router']->generate('Admin_Index');?>">Admin</a> >>
        Lugares
    </div>

    <div class="sub-menu">
        <ul>
            <li><a href="<?=$view['router']->generate('Admin_Lugares_Create');?>">Agregar Lugar</a></li>
        </ul>
    </div>

    <h2>Lugares</h2>

    <table class="table table-bordered table-striped data-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Status</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php if(empty($data)): ?>
            <tr><td colspan="4"><p>No hay lugares registradas.</p></td></tr>
        <?php else: ?>
            <?php foreach($data as $row): ?>
                <tr>
                    <td><?=$row->getID();?></td>
                    <td><?=$view->escape($row->getNombre());?></td>
                    <td>
                        <?php
                            if ( $view->escape($row->getStatus()) == '1' ) {
                                echo 'Publico';
                            }else{
                                if ( $view->escape($row->getStatus()) == '2' ) {
                                    echo 'Pendiente';
                                }
                            }
                        ?>
                    </td>
                    <td class="actions">
                        <?php if ( $view->escape($row->getStatus()) == '2' ): ?>
                            <a href="<?=$view['router']->generate('Admin_Lugares_Publicar', array('id' => $row->getID()));?>" title="Publicar lugar" class="btn deleteUser" data-userid="<?=$row->getID();?>"><i class="icon-remove"></i> Públicar</a>
                        <?php endif ?>
                        <a href="<?=$view['router']->generate('Admin_Lugares_Edit', array('id' => $row->getID()));?>" title="Edit User" class="btn"><i class="icon-edit"></i> Editar</a>
                        <a href="<?=$view['router']->generate('Admin_Lugares_Delete', array('id' => $row->getID()));?>" title="Delete User" class="btn deleteUser" data-userid="<?=$row->getID();?>"><i class="icon-remove"></i> Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

</div>