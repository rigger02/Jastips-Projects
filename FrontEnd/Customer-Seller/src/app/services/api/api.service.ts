import { Injectable } from '@angular/core';
import { AuthService } from '../auth/auth.service';
import { Router } from '@angular/router';
import { environment } from 'src/environments/environment';
import { ProductService } from '../product/product.service';
import { StoreService } from '../store/store.service';
import { AddressService } from '../address/address.service';
import { OrderService } from '../order/order.service';
import { Subject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  productAdded: Subject<void> = new Subject<void>();

  constructor(
    private router: Router,
    private authService: AuthService,
    private product: ProductService,
    private store: StoreService,
    private address: AddressService,
    private order: OrderService,
    ) { }

    emitProductAdded() {
      this.productAdded.next();
    }

  // Auth Api
  public registerUser(form : any){
    return this.authService.registerUser(form).subscribe( data => {
      const jsonResponse = JSON.parse(JSON.stringify(data));
      console.log(jsonResponse.id);
      console.log("Success ==> "+ JSON.stringify(data)); 
      this.router.navigate(['/c-tabs']);
    },
    err => {
      console.error('Gagal Create user ===> ', err.status);
    });
  }

  public loginUser(form : any){
    return this.authService.loginUser(form)
      .subscribe(async (res:any) =>{
          console.log('Data User ===>'+JSON.stringify( res['data'].role))
          console.log('Token ===>'+JSON.stringify( res['token']))
          localStorage.setItem('role',res['data'].role)
          this.authService.setToken(res['token'])
          if(res['data'].role === 'customer'){
            this.router.navigateByUrl('c-tabs')
          }else if(res['data'].role === 'store'){
            this.router.navigateByUrl('s-tabs')
          }
        });
  }

  //Product Services
  public productByStore(id:any){
    return this.product.productByStore(id)
  }
  
  public productStore(){
    return this.product.productStore()
  }

  public createProduct(data:any){
    return this.product.createProduct(data)
  }

  public deleteProduct(id:any){
    return this.product.deleteProduct(id)
  }

  public publish(id:any){
    return this.product.publish(id)
  }

  public unpublish(id:any){
    return this.product.unpublish(id)
  }



  // Store Services
  getStore(){
    return this.store.GetStore()
  }

  getStoreById(id:any){
    return this.store.GetStoreById(id)
  }


  // Address Services
  getUserAddressActive(){
    return this.address.GetUserAddressActive()
  }
  
  getUserAddress(){
    return this.address.GetUserAddress()
  }
  
  createAddress(data:any){
    return this.address.CreateAddress(data)
  }
  
  updateAddress(data:any){
    return this.address.updateAddress(data)
  }
  
  deleteAddress(id:any){
    return this.address.deleteAddress(id)
  }

  // Order Services
  addOrder(order:any){
    return this.order.addOrder(order)
  }
  
  getOrder(){
    return this.order.getUserOrder()
  }
  
  getOrderStore(){
    return this.order.getStoreOrder()
  }
  
  getOrderDetail(id:any){
    return this.order.getOrderDetails(id)
  }
  
  takeOrder(id:any){
    return this.order.takeOrder(id)
  }


}
