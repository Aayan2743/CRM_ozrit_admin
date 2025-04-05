<?php $page = 'leads'; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
	<div class="content">

		<div class="row">
			<div class="col-md-12">

				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col-4">
							<h4 class="page-title">Leads<span class="count-title"> {{$allLeadsCount}}</span></h4>
						</div>
						<div class="col-8 text-end">
							<div class="head-icons">
								<a href="{{url('leads')}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Refresh">
									<i class="ti ti-refresh-dot"></i>
								</a>
								<a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header">
									<i class="ti ti-chevrons-up"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
				<!-- /Page Header -->

				<div class="card">
					<div class="card-header">
						<!-- Search -->
						<div class="row align-items-center">
							<div class="col-sm-4">
								<div class="icon-form mb-3 mb-sm-0">
									<span class="form-icon"><i class="ti ti-search"></i></span>
									<input type="text" class="form-control" id="search-leads" placeholder="Search Leads">
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
										<i class="ti ti-square-rounded-plus me-2"></i> Add Leads
									</a>
								</div>
							</div>
						</div>
						<!-- /Search -->
					</div>


					<div class="card-body">
						<!-- Contact List -->
						<div class="table-responsive custom-table">
							<table class="table" id="leads_list">
								<thead class="thead-light">
									<tr>
										<th>Lead Name</th>
										<th>Company Name</th>
										<th>Phone</th>
										<th>Email</th>
										<th>Lead Status</th>
										<th>Created Date</th>
										<th>Lead Owner</th>
										<th class="text-end">Action</th>
									</tr>
								</thead>
								<tbody>
									<!-- Rows will be populated dynamically via JavaScript -->
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
							doc.text("Leads List", doc.internal.pageSize.getWidth() / 2, 15, {
								align: 'center'
							});

							let table = document.getElementById('leads_list');

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
							doc.save('leads_list.pdf');
						});

						document.getElementById('export-excel').addEventListener('click', function() {
							let table = document.getElementById('leads_list');

							// Remove the last column (Action column) from the table
							let rows = table.rows;
							for (let i = 0; i < rows.length; i++) {
								rows[i].deleteCell(rows[i].cells.length - 1); // Remove the last column
							}

							let wb = XLSX.utils.table_to_book(table, {
								sheet: "Leads"
							});
							XLSX.writeFile(wb, 'leads_list.xlsx');
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