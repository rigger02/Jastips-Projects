import { LoadingRestaurantComponent } from './loading-restaurant/loading-restaurant.component';
import { IonicModule } from '@ionic/angular';
import { RestaurantComponent } from './restaurant/restaurant.component';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { EmptyScreenComponent } from './empty-screen/empty-screen.component';
import { AddAddressComponent } from './modals/add-address/add-address.component';
import { FormsModule } from '@angular/forms';
import { EditAddressComponent } from './modals/edit-address/edit-address.component';



@NgModule({
  declarations: [
    RestaurantComponent,
    LoadingRestaurantComponent,
    EmptyScreenComponent,
    AddAddressComponent,
    EditAddressComponent
  ],
  imports: [
    CommonModule,
    IonicModule,
    FormsModule
  ],
  exports: [
    RestaurantComponent,
    LoadingRestaurantComponent,
    EmptyScreenComponent,
    AddAddressComponent,
    EditAddressComponent

  ],
  entryComponents: [
    AddAddressComponent,
    EditAddressComponent
  ]
})
export class ComponentsModule { }
