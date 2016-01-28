<?php

class Redis_Cache_Deflate extends Redis_Cache implements DrupalCacheInterface {
  protected function serialize($data) {
    if (is_string($data)) {
      return array(gzdeflate($data, 2), 1);
    }
    else {
      return array(gzdeflate(serialize($data), 2), 2);
    }
  }

  protected function unserialize($entry) {
    if ($entry->serialized == 2) {
      return unserialize(gzinflate($entry->data));
    }
    else {
      return gzinflate($entry->data);
    }
  }
}

