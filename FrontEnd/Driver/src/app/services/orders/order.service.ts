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

  getOrderHistory(){
    return this.http.get(environment.ApiURL+"api/driver/history",{headers : this.auth.jwt()})
  }

  getOrderReady(){
    return this.http.get(environment.ApiURL+"api/driver/getOrderReady",{headers : this.auth.jwt()})
  }

  getOrderDetails(id:any){
    return this.http.get(environment.ApiURL+'api/getOrderDetail/'+id,{headers : this.auth.jwt()})
  }
  
  takeOrder(id:any){
    return this.http.put(environment.ApiURL+'api/driver/takeOrderDriver/'+id,'',{headers : this.auth.jwt()})
  }
}
