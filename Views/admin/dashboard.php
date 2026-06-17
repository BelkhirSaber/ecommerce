<!-- Info boxes -->
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $orders_today ?? 0 ?></h3>
                <p>Commandes aujourd'hui</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="/<?= RACINE ?>/admin/orders" class="small-box-footer">
                Plus d'infos <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $orders_month ?? 0 ?></h3>
                <p>Commandes ce mois</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="/<?= RACINE ?>/admin/orders" class="small-box-footer">
                Plus d'infos <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= number_format($total_revenue ?? 0, 2) ?> <?= $currency ?? '€' ?></h3>
                <p>Chiffre d'affaires</p>
            </div>
            <div class="icon">
                <i class="fas fa-euro-sign"></i>
            </div>
            <a href="/<?= RACINE ?>/admin/analytics" class="small-box-footer">
                Plus d'infos <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $total_client ?? 0 ?></h3>
                <p>Clients</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="/<?= RACINE ?>/admin/customers" class="small-box-footer">
                Plus d'infos <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

</div>

<!-- datatable last 10 orders -->

<div class="row">
    <div class="col-md-12">
        <table id="admin-dashboard" class="display">
            <thead>
                <tr>
                    <th>Column 1</th>
                    <th>Column 2</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<!-- Chart -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ventes mensuelles</h3>
            </div>
            <div class="card-body">
                <canvas id="salesChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>