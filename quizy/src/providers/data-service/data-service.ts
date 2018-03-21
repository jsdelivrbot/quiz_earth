import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';
import 'rxjs/add/operator/map';

/*
  Generated class for the DataServiceProvider provider.
  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class DataServiceProvider {

  constructor(public http: Http) {
    console.log('Hello DataServiceProvider Provider');
  }

  getProducts(){
    return this.http.get('http://www2.cgistln.nu.ac.th/quiz_earth/qr_gen.php')
      .map((response:Response)=>response.json());
  }

}