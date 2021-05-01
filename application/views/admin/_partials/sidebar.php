<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item <?php echo $this->uri->segment(2) == '' ? 'active': '' ?>">
        <a class="nav-link" href="<?php echo site_url('admin') ?>">
            <i class="fas fa-fw fa-home"></i>
            <span>Beranda</span>
        </a>
	</li>
	<?php if ($this->session->userdata('type') == "ADMIN") { ?>
	<li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'user' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-user"></i>
            <span>Data user</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('admin/user/add') ?>">Tambah user</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/user') ?>">List user</a>
        </div>
    </li>
	<li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'customer' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-users"></i>
            <span>Data customer</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('admin/customer/add') ?>">Tambah customer</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/customer') ?>">List customer</a>
        </div>
    </li>
	<li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'piccustomer' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-user-friends"></i>
            <span>Data PIC customer</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('admin/piccustomer/add') ?>">Tambah PIC customer</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/piccustomer') ?>">List PIC customer</a>
        </div>
    </li>
	<li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'marketing' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-search-dollar"></i>
            <span>Data marketing</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('admin/marketing/add') ?>">Tambah marketing</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/marketing') ?>">List marketing</a>
        </div>
    </li>
	<li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'supplier' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-people-carry"></i>
            <span>Data supplier</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('admin/supplier/add') ?>">Tambah supplier</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/supplier') ?>">List supplier</a>
        </div>
    </li>
	<li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'barang' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Data barang</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('admin/barang/add') ?>">Tambah barang</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/barang') ?>">List barang</a>
        </div>
	</li>
	<?php } ?>
	<li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'po' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-shipping-fast"></i>
            <span>Data PO</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('admin/purchaseorder/add') ?>">Tambah po</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/purchaseorder') ?>">List po</a>
        </div>
	</li>
	<li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'po' ? 'active': '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-fw fa-cash-register"></i>
            <span>Cashflow</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?php echo site_url('admin/cashflow/add') ?>">Tambah Cashflow</a>
            <a class="dropdown-item" href="<?php echo site_url('admin/cashflow') ?>">List Cashflow</a>
        </div>
	</li>
</ul>
