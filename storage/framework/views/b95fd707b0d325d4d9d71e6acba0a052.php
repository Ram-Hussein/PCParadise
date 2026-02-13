<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Overview | PC Master</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="<?php echo e(asset('Bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/admin.style.css')); ?>" />
</head>
<body>

    <!-- Sidebar -->
    <nav class="admin-sidebar">
        <div class="px-4 mb-5">
            <h2 class="navbar-brand m-0">PC MASTER</h2>
            <p class="small opacity-75">Control Center</p>
        </div>
        <div class="nav flex-column">
            <a id="overview" href="/dashboard/overview" class="nav-link"><i class="fas fa-chart-line me-2"></i> Overview</a>
            <a id="products" href="/dashboard/products" class="nav-link"><i class="fas fa-box me-2"></i> Products</a>
            <a id="orders" href="/dashboard/orders" class="nav-link"><i class="fas fa-shopping-cart me-2"></i> Orders</a>
            <a id="users" href="/dashboard/users" class="nav-link"><i class="fas fa-users me-2"></i> Users</a>
        </div>
    </nav>

    <?php echo $__env->yieldContent('content'); ?>
    
    <script
      src="<?php echo e(asset('Bootstrap/js/bootstrap.bundle.min.js')); ?>"
    ></script>
    <?php if(isset($section)): ?>
        <script>
            const section = document.getElementById('<?php echo e($section); ?>');
            section.classList.add('active');
        </script>
    <?php endif; ?>

    <?php if(session('Error')): ?>
    <script>
        window.onload = function() {
            alert("<?php echo e(session('Error')); ?>");
        };
    </script>
    <?php endif; ?>

    <?php echo $__env->yieldContent('script'); ?>


    
</body>
</html><?php /**PATH C:\Users\RamsX\OneDrive\Desktop\Ram\Projects\Laravel Projects\PCParadise\resources\views/admin/sidebar.blade.php ENDPATH**/ ?>