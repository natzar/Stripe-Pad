/*
	Stripe Pad - Micro SaaS boilerplate
	Starter Theme - HTML
	Copyright (C) 2023 Beto Ayesa

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	This file is part of Stripe Pad.

	Stripe Pad is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

	Stripe Pad is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

	You should have received a copy of the GNU General Public License along with  Stripe Pad. If not, see <https://www.gnu.org/licenses/>.
*/
var StripePad = StripePad || {};

StripePad = {

	webhookUrl: '/webhooks/stripeGetSettings.php',
	init:function(){
		var self = this;
		this.fetch(this.webhookUrl, function(data){
			self.renderTemplate('grid','showGrid',data.products);
			self.renderTemplate('list','showList',data.products);
			
		});
	},
	fetch: function(url,callback){
		
		var request = new XMLHttpRequest();
		request.open('GET', url, true);

		request.onload = function() {
		  if (request.status >= 200 && request.status < 400) {		  
		    var data = JSON.parse(request.responseText);
		    callback(data);
		  } else {
		    // We reached our target server, but it returned an error
		  }
		};

		request.onerror = function() {
		  // There was a connection error of some sort
		};

		request.send();

	},
	renderTemplate:function(templateId, containerId, data){
		var temp = document.getElementById(templateId+'-template');
		var container = document.getElementById(containerId);
		data.forEach(function(item){
			var clon = temp.content.cloneNode(true);
			
			clon.getElementById('name').innerHTML = item['name'];
			clon.getElementById('image').src = item['images'][0];
			clon.getElementById('description').innerHTML = item['description'];
			clon.getElementById('price').innerHTML = item['price'];

			container.appendChild(clon);
		});

		
  
	},

}

StripePad.init();

