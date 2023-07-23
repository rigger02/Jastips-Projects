import { Injectable } from '@angular/core';
import { AuthService } from '../auth/auth.service';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class OrderService {

  constructor(
    private auth: AuthService,
    private http: HttpClient
  ) { }

  addOrder(order:any){
    return this.http.post(environment.ApiURL+'api/user/addOrder', order, {headers : this.auth.jwt()})
  }
  
  getUserOrder(){
    return this.http.get(environment.ApiURL+'api/user/showOrder',{headers : this.auth.jwt()})
  }

  getStoreOrder(){
    return this.http.get(environment.ApiURL+'api/seller/orderStore',{headers : this.auth.jwt()})
  }
  
  getOrderDetails(id:any){
    return this.http.get(environment.ApiURL+'api/getOrderDetail/'+id,{headers : this.auth.jwt()})
  }
  
  takeOrder(id:any){
    return this.http.put(environment.ApiURL+'api/seller/takeOrder/'+id,'',{headers : this.auth.jwt()})
    
  }



}
