

<?php $__env->startSection('title', 'Edit Actor — Video Store'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="page-header">
        <div class="page-title">
            <i class="bi bi-people"></i> Edit Actor
        </div>
        <a href="<?php echo e(route('actors.index')); ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
    <div class="form-card">
        <h2><i class="bi bi-pencil-square"></i> Edit Actor</h2>
        <form method="POST" action="<?php echo e(route('actors.update', $actor->actor_id)); ?>">
            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
            <label>Name</label>
            <input type="text" name="name" value="<?php echo e(old('name', $actor->name)); ?>">
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="error-msg"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
                <a href="<?php echo e(route('actors.index')); ?>" class="btn btn-secondary"><i class="bi bi-x"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>@extends('layouts.app')

<?php $__env->startSection('title', 'Edit Actor — Video Store'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="page-header">
        <div class="page-title">
            <i class="bi bi-people"></i> Edit Actor
        </div>
        <a href="<?php echo e(route('actors.index')); ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
    <div class="form-card">
        <h2><i class="bi bi-pencil-square"></i> Edit Actor</h2>
        <form method="POST" action="<?php echo e(route('actors.update', $actor->actor_id)); ?>">
            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
            <label>Name</label>
            <input type="text" name="name" value="<?php echo e(old('name', $actor->name)); ?>">
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="error-msg"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
                <a href="<?php echo e(route('actors.index')); ?>" class="btn btn-secondary"><i class="bi bi-x"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Charlz keneth\video_store\resources\views/actors/edit.blade.php ENDPATH**/ ?>