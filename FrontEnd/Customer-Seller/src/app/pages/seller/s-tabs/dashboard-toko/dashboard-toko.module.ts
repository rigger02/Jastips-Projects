import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { DashboardTokoPageRoutingModule } from './dashboard-toko-routing.module';

import { DashboardTokoPage } from './dashboard-toko.page';
import { NgApexchartsModule } from 'ng-apexcharts';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    DashboardTokoPageRoutingModule,
    NgApexchartsModule
  ],
  declarations: [DashboardTokoPage]
})
export class DashboardTokoPageModule {}
