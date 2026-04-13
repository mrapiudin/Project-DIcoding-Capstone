<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiProxyController extends Controller
{
    protected string $apiBase;

    public function __construct()
    {
        $this->apiBase = env('LUMEN_API_URL', 'http://localhost:8000/api');
    }

    // ── Generic helpers ────────────────────────────────────────────────────
    private function api(string $method, string $path, array $data = [])
    {
        $url = rtrim($this->apiBase, '/') . '/' . ltrim($path, '/');
        $response = Http::timeout(10)->{$method}($url, $data);
        return response()->json($response->json(), $response->status());
    }

    // ── Activities ─────────────────────────────────────────────────────────
    public function activitiesIndex()          { return $this->api('get',    'activities'); }
    public function activitiesStore(Request $r){ return $this->api('post',   'activities', $r->all()); }
    public function activitiesShow($id)        { return $this->api('get',    "activities/{$id}"); }
    public function activitiesUpdate(Request $r, $id){ return $this->api('put', "activities/{$id}", $r->all()); }
    public function activitiesDestroy($id)     { return $this->api('delete', "activities/{$id}"); }

    // ── Sleep ──────────────────────────────────────────────────────────────
    public function sleepIndex()               { return $this->api('get',    'sleep'); }
    public function sleepStore(Request $r)     { return $this->api('post',   'sleep', $r->all()); }
    public function sleepShow($id)             { return $this->api('get',    "sleep/{$id}"); }
    public function sleepUpdate(Request $r,$id){ return $this->api('put',    "sleep/{$id}", $r->all()); }
    public function sleepDestroy($id)          { return $this->api('delete', "sleep/{$id}"); }

    // ── Articles ───────────────────────────────────────────────────────────
    public function articlesIndex()            { return $this->api('get',    'articles'); }
    public function articlesStore(Request $r)  { return $this->api('post',   'articles', $r->all()); }
    public function articlesShow($id)          { return $this->api('get',    "articles/{$id}"); }
    public function articlesUpdate(Request $r,$id){ return $this->api('put', "articles/{$id}", $r->all()); }
    public function articlesDestroy($id)       { return $this->api('delete', "articles/{$id}"); }

    // ── Users ──────────────────────────────────────────────────────────────
    public function usersIndex()               { return $this->api('get',    'users'); }
    public function usersStore(Request $r)     { return $this->api('post',   'users', $r->all()); }
    public function usersShow($id)             { return $this->api('get',    "users/{$id}"); }
    public function usersUpdate(Request $r,$id){ return $this->api('put',    "users/{$id}", $r->all()); }
    public function usersDestroy($id)          { return $this->api('delete', "users/{$id}"); }
}
