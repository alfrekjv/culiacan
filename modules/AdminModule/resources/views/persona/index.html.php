<?php $view->extend('::admin.html.php'); ?>
<?php $view['slots']->start('include_css') ?>
<link rel="stylesheet" href="<?php echo $view['assets']->getUrl('admin/css/catalogos/marcas/index.css') ?>" />
<?php $view['slots']->stop(); ?>

<div class="inner">

    <div class="breadcrumb">
        <a href="<?=$view['router']->generate('Admin_Index');?>">Admin</a> >>
        Personas
    </div>

    <div class="sub-menu">
        <ul>
            <li><a href="<?=$view['router']->generate('Admin_Personas_Create');?>">Agregar Persona</a></li>
        </ul>
    </div>

    <h2>Personas</h2>

    <h5>ENCONTRADAS : <?php echo $total_encontradas; ?>&nbsp;&nbsp;&nbsp;&nbsp;EN ALBERGUES : <?php echo $total_albergue; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DESAPARECIDAS : <?php echo $total_desaparecidos; ?></h5>

    <table class="table table-bordered table-striped data-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Nombre Completo</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php if(empty($data)): ?>
            <tr><td colspan="4"><p>No hay Personas registradas.</p></td></tr>
        <?php else: ?>
            <?php foreach($data as $row): ?>
                <tr>
                    <td><?=$row->getID();?></td>
                    <td><?=$view->escape($row->getNombre());?> <?=$view->escape($row->getApellidos());?></td>
                    <td>
                        <?=mb_strtoupper($view->escape($row->getStatus()));?>
                    </td>
                    <td class="actions">
                        <a href="<?=$view['router']->generate('Admin_Personas_Edit', array('id' => $row->getID()));?>" title="Editar Persona" class="btn"><i class="icon-edit"></i> Editar</a>
                        <a href="<?=$view['router']->generate('Admin_Personas_Delete', array('id' => $row->getID()));?>" title="Eliminar Persona" class="btn deleteUser" data-userid="<?=$row->getID();?>"><i class="icon-remove"></i> Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

</div>