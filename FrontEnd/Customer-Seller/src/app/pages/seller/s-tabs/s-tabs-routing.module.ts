import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { STabsPage } from './s-tabs.page';

const routes: Routes = [
  {
    path: '',
    component: STabsPage,
    children: [
      
  {
    path: 'home',
    loadChildren: () => import('./dashboard-toko/dashboard-toko.module').then( m => m.DashboardTokoPageModule)
  },
  {
    path: 'product',
    loadChildren: () => import('./produk/produk.module').then( m => m.ProdukPageModule)
  },
  {
    path: 'orders',
    loadChildren: () => import('./pesanan/pesanan.module').then( m => m.PesananPageModule)
  },
  {
    path: 'account',
    loadChildren: () => import('./account/account.module').then( m => m.AccountPageModule)
  },

  {
    path: '',
    redirectTo: '/s-tabs/home',
    pathMatch: 'full'
  }
    ]},
  {
    path: 'order-detail/:id',
    loadChildren: () => import('./order-detail/order-detail.module').then( m => m.OrderDetailPageModule)
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class STabsPageRoutingModule {}
