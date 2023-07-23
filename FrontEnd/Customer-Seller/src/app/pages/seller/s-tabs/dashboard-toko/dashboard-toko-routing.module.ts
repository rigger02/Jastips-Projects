import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { DashboardTokoPage } from './dashboard-toko.page';

const routes: Routes = [
  {
    path: '',
    component: DashboardTokoPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class DashboardTokoPageRoutingModule {}
