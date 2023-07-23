import { Injectable } from '@angular/core';
import { AuthService } from '../auth/auth.service';
import { OrderService } from '../orders/order.service';

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  constructor(
    private auth:AuthService,
    private order: OrderService
    ) { }
  
  // Auth
  public loginDriver(form:any){
    return this.auth.loginDriver(form)
  }


  // Order
  public getOrderHistory(){
    return this.order.getOrderHistory()
  }
  
  public getOrderReady(){
    return this.order.getOrderReady()
  }
  
  public getOrderDetail(id:any){
    return this.order.getOrderDetails(id)
  }
  
  public takeOrder(id:any){
    return this.order.takeOrder(id)
  }
}
