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
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php if(empty($data)): ?>
            <tr><td colspan="5"><p>No hay lugares registradas.</p></td></tr>
        <?php else: ?>
            <?php foreach($data as $row): ?>
                <tr>
                    <td><?=$row->getID();?></td>
                    <td><?=$view->escape($row->getNombre());?></td>
                    <td class="actions">
                        <a href="<?=$view['router']->generate('Admin_Lugares_Edit', array('id' => $row->getID()));?>" title="Edit User" class="btn"><i class="icon-edit"></i> Editar</a>
                        <a href="<?=$view['router']->generate('Admin_Lugares_Delete', array('id' => $row->getID()));?>" title="Delete User" class="btn deleteUser" data-userid="<?=$row->getID();?>"><i class="icon-remove"></i> Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

</div>