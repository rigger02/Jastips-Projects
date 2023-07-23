import { Injectable } from '@angular/core';
import { AuthService } from '../auth/auth.service';
import { HttpClient} from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class StoreService {

  constructor(
    private auth:AuthService,
    private http:HttpClient
  ) { }

  public GetStore(){
    return this.http.get(environment.ApiURL+'api/store');
  }

  public GetStoreById(id){
    return this.http.get(environment.ApiURL+'api/storeId/'+id);
  }



}
