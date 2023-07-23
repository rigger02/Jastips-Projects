import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    redirectTo: 'c-tabs',
    pathMatch: 'full'
  },
  {
    path: 'c-tabs',
    loadChildren: () => import('./pages/customer/tabs/tabs.module').then( m => m.TabsPageModule)
  },
  {
    path: 's-tabs',
    loadChildren: () => import('./pages/seller/s-tabs/s-tabs.module').then( m => m.STabsPageModule)
  },
  {
    path: 'login',
    loadChildren: () => import('./pages/welcome/login/login.module').then( m => m.LoginPageModule)
  },
  {
    path: 'onboard',
    loadChildren: () => import('./pages/welcome/onboard/onboard.module').then( m => m.OnboardPageModule)
  },
  {
    path: 'register',
    loadChildren: () => import('./pages/welcome/register/register.module').then( m => m.RegisterPageModule)
  },
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }
