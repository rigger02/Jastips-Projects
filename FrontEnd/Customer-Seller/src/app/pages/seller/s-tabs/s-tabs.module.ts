import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { STabsPageRoutingModule } from './s-tabs-routing.module';

import { STabsPage } from './s-tabs.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    STabsPageRoutingModule
  ],
  declarations: [STabsPage]
})
export class STabsPageModule {}
