<?php $__env->startSection('title', 'Movies — Video Store'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="page-header">
        <div class="page-title">
            <i class="bi bi-film"></i> Movies
        </div>
        <a href="<?php echo e(route('movies.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add Movie
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i> <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form method="GET" action="<?php echo e(route('movies.index')); ?>" class="search-bar">
        <i class="bi bi-search"></i>
        <input type="text" name="search" placeholder="Search by title, category, director or actor..." value="<?php echo e(request('search')); ?>">
        <?php if(request('search')): ?>
            <a href="<?php echo e(route('movies.index')); ?>" class="btn btn-ghost"><i class="bi bi-x"></i></a>
        <?php endif; ?>
    </form>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Director</th>
                    <th>Year</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($movie->movie_id); ?></td>
                    <td>
                        <?php if($movie->image): ?>
                            <img src="<?php echo e(asset('storage/' . $movie->image)); ?>" alt="<?php echo e($movie->title); ?>" class="table-thumb">
                        <?php else: ?>
                            <span style="color:#475569;font-size:0.75rem;">—</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($movie->title); ?></td>
                    <td><?php echo e($movie->category); ?></td>
                    <td><?php echo e($movie->director); ?></td>
                    <td><?php echo e($movie->year); ?></td>
                    <td>
                        <div class="actions">
                            <a href="<?php echo e(route('movies.edit', $movie->movie_id)); ?>" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <?php if(session('role') == 'admin'): ?>
                            <form method="POST" action="<?php echo e(route('movies.destroy', $movie->movie_id)); ?>">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-danger" onclick="return confirm('Delete this movie?')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="7" style="text-align:center;color:#475569;padding:2rem;">No movies yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Charlz keneth\video_store\resources\views/movies/index.blade.php ENDPATH**/ ?>