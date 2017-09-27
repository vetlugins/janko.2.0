<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Illuminate\Support\Facades\File;

class Files extends BaseModel {

    protected $guarded = ['id'];
    protected $path  = '/system/Doc';
    protected $table = 'link_files';
    protected $scoped_by = ['object_type', 'object_id'];

    public function objectable() {
        return $this->morphTo();
    }

    public function trans_filename () {
        if ($filename) {
            $filename = strtr($filename, Config::get('mdata/translit.letters'));
            $filename = mb_strtolower($filename);
        }

        $this->setAttribute($name.'_file_name', $filename);

        return $this;
    }

    public function get_path () {
        return public_path() . $this->path . '/' . $this->objectable_type . '/' . $this->objectable_id;
    }

    public function get_link() {
        return $this->path . '/' . $this->objectable_type . '/' . $this->objectable_id . '/' . $this->filename;
    }

    public function delete_files($item){
        File::delete($item);
    }
}
