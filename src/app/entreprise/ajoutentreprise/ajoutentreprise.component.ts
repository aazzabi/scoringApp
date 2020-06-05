import { Component, OnInit, Input } from '@angular/core';
import { EntrepriseService } from 'src/app/services/entreprise.service';
import { Entreprise } from 'src/app/models/Entreprise';
import { Router } from '@angular/router';

@Component({
  selector: 'app-ajoutentreprise',
  templateUrl: './ajoutentreprise.component.html',
  styleUrls: ['./ajoutentreprise.component.css']
})
export class AjoutentrepriseComponent implements OnInit {

  constructor(private entrserv:EntrepriseService,private router:Router) { }
  entreprise: Entreprise = new Entreprise();
  ngOnInit() {
  }
  addentreprise(){
  //router.navigate : redirection
  this.entrserv.AjoutEntreprise(this.entreprise).subscribe(data=>this.router.navigate(['/menu/entreprises']))

}
}
