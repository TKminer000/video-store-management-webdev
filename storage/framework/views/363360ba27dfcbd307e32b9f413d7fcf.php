<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Video Store'); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #0f172a; color: #e2e8f0; min-height: 100vh; }

        /* Navbar */
        .navbar {
            background: #1e293b;
            padding: 0.9rem 2rem;
            display: flex; justify-content: space-between; align-items: center;
            border-bottom: 1px solid #334155;
            position: sticky; top: 0; z-index: 100;
        }
        .navbar-brand {
            display: flex; align-items: center; gap: 0.5rem;
            font-size: 1.1rem; font-weight: 600; color: #f1f5f9;
            text-decoration: none;
        }
        .navbar-brand i { color: #818cf8; font-size: 1.3rem; }
        .navbar-right { display: flex; align-items: center; gap: 1rem; }
        .navbar-user { display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: #94a3b8; }
        .navbar-user i { font-size: 1rem; }

        /* Badges */
        .badge { padding: 0.2rem 0.6rem; border-radius: 999px; font-size: 0.7rem; font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase; }
        .badge-admin { background: #312e81; color: #a5b4fc; }
        .badge-staff { background: #164e63; color: #67e8f9; }
        .badge-vhs   { background: #1e3a5f; color: #93c5fd; }
        .badge-beta  { background: #3b1f5e; color: #d8b4fe; }

        /* Buttons */
        .btn { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.45rem 0.9rem; border-radius: 6px; font-size: 0.85rem; cursor: pointer; border: none; text-decoration: none; font-weight: 500; transition: opacity 0.15s; }
        .btn:hover { opacity: 0.85; }
        .btn-primary  { background: #4f46e5; color: #fff; }
        .btn-warning  { background: #d97706; color: #fff; }
        .btn-danger   { background: #dc2626; color: #fff; }
        .btn-secondary{ background: #334155; color: #cbd5e1; }
        .btn-ghost    { background: transparent; color: #94a3b8; border: 1px solid #334155; }
        .btn-ghost:hover { background: #1e293b; opacity: 1; }

        /* Container */
        .container { max-width: 1100px; margin: 2rem auto; padding: 0 1.5rem; }

        /* Page header */
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .page-title { display: flex; align-items: center; gap: 0.6rem; font-size: 1.3rem; font-weight: 600; color: #f1f5f9; }
        .page-title i { color: #818cf8; }

        /* Alerts */
        .alert { padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 1.25rem; font-size: 0.875rem; display: flex; align-items: center; gap: 0.5rem; }
        .alert-success { background: #052e16; color: #86efac; border: 1px solid #166534; }
        .alert-error   { background: #2d0a0a; color: #fca5a5; border: 1px solid #991b1b; }

        /* Table */
        .table-wrap { background: #1e293b; border-radius: 12px; overflow: hidden; border: 1px solid #334155; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #0f172a; color: #94a3b8; padding: 0.75rem 1rem; text-align: left; font-size: 0.75rem; font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase; border-bottom: 1px solid #334155; }
        td { padding: 0.85rem 1rem; border-bottom: 1px solid #1e293b; font-size: 0.875rem; color: #cbd5e1; }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover td { background: #263244; }
        .actions { display: flex; gap: 0.5rem; }

        /* Card form */
        .form-card { background: #1e293b; padding: 2rem; border-radius: 12px; border: 1px solid #334155; max-width: 560px; }
        .form-card h2 { font-size: 1.1rem; font-weight: 600; color: #f1f5f9; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; }
        .form-card h2 i { color: #818cf8; }
        label { display: block; font-size: 0.8rem; font-weight: 600; color: #94a3b8; margin-bottom: 0.3rem; text-transform: uppercase; letter-spacing: 0.04em; }
        input, select { width: 100%; padding: 0.6rem 0.85rem; background: #0f172a; border: 1px solid #334155; border-radius: 6px; font-size: 0.9rem; color: #e2e8f0; margin-bottom: 1.1rem; }
        input:focus, select:focus { outline: none; border-color: #4f46e5; }
        input::placeholder { color: #475569; }
        input:disabled { opacity: 0.5; cursor: not-allowed; }
        .hint { color: #475569; font-size: 0.78rem; margin-top: -0.85rem; margin-bottom: 0.9rem; }
        .error-msg { color: #f87171; font-size: 0.78rem; margin-top: -0.85rem; margin-bottom: 0.9rem; }
        .form-footer { display: flex; gap: 0.75rem; margin-top: 0.5rem; }

        /* Dashboard cards */
        .cards-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem; }
        .dash-card { background: #1e293b; border: 1px solid #334155; border-radius: 12px; padding: 1.5rem 1rem; text-align: center; text-decoration: none; color: inherit; transition: border-color 0.15s, transform 0.15s; display: block; }
        .dash-card:hover { border-color: #4f46e5; transform: translateY(-2px); }
        .dash-card i { font-size: 1.8rem; color: #818cf8; display: block; margin-bottom: 0.6rem; }
        .dash-card h3 { font-size: 0.95rem; font-weight: 600; color: #f1f5f9; }
        .dash-card p { font-size: 0.78rem; color: #64748b; margin-top: 0.2rem; }

        /* Welcome box */
        .welcome-box { background: #1e293b; border: 1px solid #334155; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; }
        .welcome-box h2 { font-size: 1.2rem; font-weight: 600; color: #f1f5f9; margin-bottom: 0.25rem; }
        .welcome-box p { font-size: 0.875rem; color: #64748b; }

        /* Login */
        .login-wrap { display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 1rem; }

        /* Status badges */
        .badge-available { background: #052e16; color: #86efac; }
        .badge-rented    { background: #2d0a0a; color: #fca5a5; }

        /* Table thumbnails */
        .table-thumb { width: 40px; height: 56px; object-fit: cover; border-radius: 4px; display: block; }

        /* Search bar */
        .search-bar { display: flex; align-items: center; gap: 0.5rem; background: #1e293b; border: 1px solid #334155; border-radius: 8px; padding: 0.5rem 1rem; margin-bottom: 1.25rem; }
        .search-bar i { color: #64748b; font-size: 1rem; flex-shrink: 0; }
        .search-bar input { background: none; border: none; padding: 0; margin: 0; color: #e2e8f0; font-size: 0.9rem; }
        .search-bar input:focus { outline: none; border: none; }

        /* Section title */
        .section-title { display: flex; align-items: center; gap: 0.5rem; font-size: 1.1rem; font-weight: 600; color: #f1f5f9; margin-bottom: 1rem; margin-top: 2rem; }
        .section-title i { color: #818cf8; }
        .section-title:first-of-type { margin-top: 0; }

        /* Dashboard management links */
        .manage-links { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem; margin-bottom: 2rem; }

        /* Movie grid for dashboard */
        .movie-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 1.25rem; }
        .movie-card { background: #1e293b; border: 1px solid #334155; border-radius: 12px; overflow: hidden; transition: border-color 0.15s, transform 0.15s; }
        .movie-card:hover { border-color: #4f46e5; transform: translateY(-2px); }
        .movie-card-img { width: 100%; height: 240px; overflow: hidden; background: #0f172a; display: flex; align-items: center; justify-content: center; }
        .movie-card-img img { width: 100%; height: 100%; object-fit: cover; }
        .movie-card-placeholder { display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; }
        .movie-card-placeholder i { font-size: 3rem; color: #334155; }
        .movie-card-body { padding: 0.85rem; }
        .movie-card-body h4 { font-size: 0.9rem; font-weight: 600; color: #f1f5f9; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .movie-card-meta { font-size: 0.75rem; color: #64748b; margin-top: 0.2rem; }
        .movie-card-stats { display: flex; gap: 0.6rem; margin-top: 0.5rem; }
        .movie-card-stats .stat { font-size: 0.7rem; font-weight: 600; padding: 0.15rem 0.5rem; border-radius: 999px; }
        .stat.available { background: #052e16; color: #86efac; }
        .stat.rented { background: #2d0a0a; color: #fca5a5; }

        .login-card { background: #1e293b; border: 1px solid #334155; border-radius: 16px; padding: 2.5rem; width: 100%; max-width: 380px; }
        .login-card .brand { text-align: center; margin-bottom: 2rem; }
        .login-card .brand i { font-size: 2.5rem; color: #818cf8; display: block; margin-bottom: 0.5rem; }
        .login-card .brand h1 { font-size: 1.4rem; font-weight: 700; color: #f1f5f9; }
        .login-card .brand p { font-size: 0.85rem; color: #64748b; margin-top: 0.25rem; }
    </style>
</head>
<body>
    <?php if (! empty(trim($__env->yieldContent('no-navbar')))): ?>
    <?php else: ?>
    <nav class="navbar">
        <a href="<?php echo e(route('dashboard')); ?>" class="navbar-brand">
            <i class="bi bi-film"></i> Video Store
        </a>
        <div class="navbar-right">
            <div class="navbar-user">
                <i class="bi bi-person-circle"></i>
                <?php echo e(session('name')); ?>

                <span class="badge badge-<?php echo e(session('role')); ?>"><?php echo e(session('role')); ?></span>
            </div>
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button class="btn btn-ghost"><i class="bi bi-box-arrow-right"></i> Logout</button>
            </form>
        </div>
    </nav>
    <?php endif; ?>

    <?php echo $__env->yieldContent('content'); ?>
</body>
</html><?php /**PATH C:\Users\Charlz keneth\video_store\resources\views/layouts/app.blade.php ENDPATH**/ ?>