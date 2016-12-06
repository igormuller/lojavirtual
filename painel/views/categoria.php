<h1>Categorias</h1>
<a href="/painel/categoria/add" class="btn btn-default">Adicionar</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Titulo</th>
            <th width="150">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categorias as $cat): ?>
        <tr>
            <td><?php echo $cat['titulo']; ?></td>
            <td>
                <a href="/painel/categoria/edit/<?php echo $cat['id']; ?>" class="btn btn-sm btn-default">Editar</a>
                <a href="/painel/categoria/remove/<?php echo $cat['id']; ?>" class="btn btn-sm btn-default">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>       
    
</table>