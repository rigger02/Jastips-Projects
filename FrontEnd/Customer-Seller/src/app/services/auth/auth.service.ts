import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Preferences } from '@capacitor/preferences';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  private tokenKey = 'auth_token';

  constructor(
    private http: HttpClient
  ) { }

  jwt(){
    let token = localStorage.getItem('token')
    return new HttpHeaders({
      'Authorization': token,
      'Access-Control-Allow-Origin' : '*'
    })
  }

  setToken(token: string){
    localStorage.setItem('token',token)
  }

  async removeToken(): Promise<void> {
    await Preferences.remove({ key: this.tokenKey });
  }

  async isAuthenticated(): Promise<boolean> {
    const token = await this.jwt();
    return token !== null;
  }

  public registerUser(form : any){
    return this.http.post(environment.ApiURL + 'api/register',
      {
        "name_tmu": form.name_tmu,
        "phone_tmu": form.phone_tmu,
        "password": form.password
      },
      { responseType: 'json'}
    )
  }

  public loginUser(form : any){
    return this.http.post(environment.ApiURL + 'api/login',
      {
        "phone_tmu": form.phone_tmu,
        "password": form.password
      },
      { responseType: 'json'}
    )
  }

}
