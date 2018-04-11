<template>
<div class="content-wrapper">
<div class="container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
	<slot name="contentHeader">
			
	</slot>
  </section>

  <!-- Main content -->
  <section class="content">
	<div class="row">
		<div class="col-xs-12">
			<slot name="content">
			
			</slot>
		</div>
	</div>
  </section>
</div>
</div>
<!--
	Daftar slot :
	1. contentHeader
		Mengisi header dari artikel
	2. content
		Mengisi content
-->
</template>
