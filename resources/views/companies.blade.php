<?php $page = 'companies'; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content">

		<div class="row">
			<div class="col-md-12">


				@component('components.breadcrumb')
				@slot('title')
				Companies
				@endslot
				@slot('item1')
				{{ $allClientsCount }}
				@endslot
				@slot('item2')
				companies
				@endslot
				@endcomponent

				<div class="card ">
					<div class="card-header">
						<!-- Search -->
						<div class="row align-items-center">
							<div class="col-sm-4">
								<div class="icon-form mb-3 mb-sm-0">
									<span class="form-icon"><i class="ti ti-search"></i></span>
									<input type="text" class="form-control" id="search-companies" placeholder="Search Companies">
								</div>
							</div>
							<div class="col-sm-8">
								<div class="d-flex align-items-center flex-wrap row-gap-2 justify-content-sm-end">
									<div class="dropdown me-2">
										<a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown">
											<i class="ti ti-package-export me-2"></i> Export
										</a>
										<div class="dropdown-menu dropdown-menu-end">
											<ul>
												<li>
													<a href="javascript:void(0);" class="dropdown-item" id="export-pdf">
														<i class="ti ti-file-type-pdf text-danger me-1"></i> Export as PDF
													</a>
												</li>
												<li>
													<a href="javascript:void(0);" class="dropdown-item" id="export-excel">
														<i class="ti ti-file-type-xls text-green me-1"></i> Export as Excel
													</a>
												</li>
											</ul>
										</div>
									</div>
									<a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_add">
										<i class="ti ti-square-rounded-plus me-2"></i> Add Company
									</a>
								</div>
							</div>
						</div>
						<!-- /Search -->
					</div>
					<div class="card-body">


						<!-- Contact List -->
						<div class="table-responsive custom-table">
							<table class="table" id="companieslist">
								<thead class="thead-light">
									<tr>
										<th>Name</th>
										<th>Phone</th>
										<th>Email</th>
										<th>Source</th>
										<th>Industry</th>
										<th>Owner</th>
										<th>Created Date</th>
										<th>Status</th>
										<th class="text-end">Action</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
						</div>
						<div class="row align-items-center">
							<div class="col-md-6">
								<div class="datatable-length"></div>
							</div>
							<div class="col-md-6">
								<div class="datatable-paginate"></div>
							</div>
						</div>
						<!-- /Contact List -->

					</div>
					<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
					<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.19/jspdf.plugin.autotable.min.js"></script>
					<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>
					<script>
						document.getElementById('export-pdf').addEventListener('click', function() {
							const {
								jsPDF
							} = window.jspdf;
							const doc = new jsPDF();

							// Title (Centered)
							doc.setFontSize(18);
							doc.text("Companies List", doc.internal.pageSize.getWidth() / 2, 15, {
								align: 'center'
							});

							let table = document.getElementById('companieslist');

							// Remove the last column (Action column) from the table
							let rows = table.rows;
							for (let i = 0; i < rows.length; i++) {
								rows[i].deleteCell(rows[i].cells.length - 1); // Remove the last column
							}

							doc.autoTable({
								html: table,
								startY: 30,
								theme: 'grid',
								margin: {
									top: 30,
									bottom: 20,
									left: 10,
									right: 10
								},
								columnStyles: {
									0: {
										cellWidth: 'auto',
										halign: 'center'
									},
									1: {
										cellWidth: 'auto',
										halign: 'center'
									},
									2: {
										cellWidth: 'auto',
										halign: 'center'
									},
									3: {
										cellWidth: 'auto',
										halign: 'center'
									},
									4: {
										cellWidth: 'auto',
										halign: 'center'
									},
									5: {
										cellWidth: 'auto',
										halign: 'center'
									},
									6: {
										cellWidth: 'auto',
										halign: 'center'
									},
									7: {
										cellWidth: 'auto',
										halign: 'center'
									}
								},
								bodyStyles: {
									valign: 'middle',
									fontSize: 10
								},
								didDrawPage: function(data) {
									const pageWidth = doc.internal.pageSize.getWidth();
									const pageHeight = doc.internal.pageSize.getHeight();

									doc.setLineWidth(0.5);
									doc.line(10, 25, pageWidth - 10, 25);
									const pageCount = doc.internal.getNumberOfPages();
									doc.text(`Page ${doc.internal.getCurrentPageInfo().pageNumber} of ${pageCount}`, pageWidth - 40, pageHeight - 10);
								},
								pageBreak: 'auto',
							});
							doc.save('companies_list.pdf');
						});

						document.getElementById('export-excel').addEventListener('click', function() {
							let table = document.getElementById('companieslist');

							// Remove the last column (Action column) from the table
							let rows = table.rows;
							for (let i = 0; i < rows.length; i++) {
								rows[i].deleteCell(rows[i].cells.length - 1); // Remove the last column
							}

							let wb = XLSX.utils.table_to_book(table, {
								sheet: "Leads"
							});
							XLSX.writeFile(wb, 'companies_list.xlsx');
						});
					</script>
				</div>

			</div>
		</div>

	</div>
</div>
<!-- /Page Wrapper -->
@component('components.model-popup')
@endcomponent
@endsection