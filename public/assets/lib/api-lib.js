/** Walulel API Lib
 * ======================
 * Handles JWT Authentication
 * Stores token for subsequent ajax requests
 * Uses LocalStorage
 *
 *
 * Functions
 * ==============
 * postcodes()
 * i_postcode(postcode)
 *
 * @author	marcek
 * @email	ddecs23@gmail.com
 * @version	1.0.3
 *
**/

"use strict";

if( typeof jQuery === "undefined" ) {
	throw new Error('This Library requires jQuery to run');
}



function Storage() {
	this._storage = {};
}

Storage.prototype.set = function(data) {
    this._storage = data;
};

Storage.prototype.get = function() {
    return this._storage;
};

// Storage.prototype.append = function(data) {
//     this._storage = data;
// };

// Storage.prototype.clear = function() {
//     this._storage = {};
// };

// function Stack() {
// 	this._size = 0;
// 	this._storage = {};
// }

// Stack.prototype.push = function(data) {
//     // increases the size of our storage
//     var size = this._size++;
 
//     // assigns size as a key of storage
//     // assigns data as the value of this key
//     this._storage[size] = data;
// };

// Stack.prototype.pop = function() {
//     var size = this._size,
//         deletedData;
 
//     if (size) {
//         deletedData = this._storage[size];
 
//         delete this._storage[size];
//         this._size--;
 
//         return deletedData;
//     }
// };

// Stack.prototype.clear = function() {
//     var size = 0;
 
//     this._storage = {};
// };


(function ($) {

	// var base = 'http://192.168.121.135/marcek/wl/public/api/';
	// var base = 'http://localhost/marcek/wl/public/api/';
	var base = 'http://50.112.128.98/api/';

	window.Wl = {};
	window.Wl.data = new Storage;

	var Obj = {
		credentials: {
			username: 'marcek',
			password: 'admin'
		},
		url: {
			get_token: base + 'auth/signin',
			postcodes: base + 'postcodes',
			i_postcode: base + 'postcode/',
		},
		postcodes: {}
	}

	// set up localStorage
	if( !store.enabled ) {
		throw new Error('This library requires LocalStorage which is not supported in your browser. Please disable "Private Mode", or switch browsers..');
	} else {
		// init token storage
		// store.clear();
		// init_store();
	}

	function init_store(token) {
		if( store.enabled ) {
			store.set('wl_api_token', token);
		}
		return;
	}

	function check_store() {
		if( store.enabled ) {
			var val = store.get('wl_api_token');
			if( val ) {
				return val;
			} else {
				return '';
			}
		}
		return;
	}

	function _ajax(opt, successfunc, donefunc) {

		var options = {
		    async: true,
		    crossDomain: true,
		    url: opt.url,
		    method: opt.method,
		    data: opt.data,
		    headers: {
		        "Accept": "application/json",
		        "Authorization": "Bearer " + opt.token,
		        // "Access-Control-Allow-Headers": "Origin",
		        // "Access-Control-Allow-Origin": "*",
		        // "Access-Control-Allow-Origin" : "*",
		        // "Access-Control-Allow-Methods" : "GET,POST,PUT,DELETE,OPTIONS",
		        // "Access-Control-Allow-Headers": "Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"
		    },
		    success: function(res) {
		    	successfunc(res);
		    },
		    error: function(xhr, textStatus, errorThrown) {
		    	console.log('Ajax Error: ' + errorThrown);
		    	// console.log(xhr.responseText);
		    	// console.log(xhr);
		    }
		}

		return typeof(donefunc) == 'function' ? $.ajax(options).done(donefunc) : $.ajax(options);

	}

	window.Wl.postcodes = function (func, limit = 4000) {
		get_poscodes(func, limit);
	}

	window.Wl.i_postcode = function(postcode, func) {
		get_postcode_details(postcode, func);
	}

	function get_postcode_details(postcode, func) {
		_ajax({
			url: Obj.url.i_postcode + postcode,
			method: 'GET',
			data: {},
			token: check_store().token
		}, function(res) {
			window.Wl.data.set(res.data);
			func(window.Wl.data.get());
		});
	}

	function get_poscodes(func, limit) {
		_ajax({
			url: Obj.url.postcodes + '/' + limit,
			// url: Obj.url.postcodes + '/' + limit,
			method: 'GET',
			data: {},
			token: check_store().token
		}, function(res) {
			window.Wl.data.set(res.data);
			func(window.Wl.data.get());
		});
	}

	$(function set_token() {
		_ajax({
			url: Obj.url.get_token,
			method: 'POST',
			data: Obj.credentials,
			token: ''
		}, function(res) {
			// store token in cache
			init_store(res);
		});	
	})

})(jQuery)




