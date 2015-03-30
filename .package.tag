#!/usr/bin/env bash

if [ 1 -gt $# ]; then
    printf "\e[31mUsage : ./.package.tag <tag> [branch].\e[m\n"
    exit 1;
elif [ 2 -gt $# ]; then
    VERSION=$1;
    TARGET_BRANCH=master
else
    VERSION=$1;
    TARGET_BRANCH=$2;
fi

echo ${VERSION}
echo ${TARGET_BRANCH}


# Tag Origin
git checkout ${TARGET_BRANCH} 
git tag -f ${VERSION}
git push origin ${TARGET_BRANCH}

# Tag Core 
git checkout refs/remotes/core/${TARGET_BRANCH} 
git tag -f core.${VERSION}
git push core core.${VERSION}:${VERSION}

# Tag Http Extension  
git checkout refs/remotes/extension.http/${TARGET_BRANCH} 
git tag -f extension.http.${VERSION}
git push extension.http extension.http.${VERSION}:${VERSION}

# Tag CQL Extension 
git checkout refs/remotes/extension.cql/${TARGET_BRANCH} 
git tag -f extension.cql.${VERSION}
git push extension.cql extension.cql.${VERSION}:${VERSION}

# Tag Extra Extension 
git checkout refs/remotes/extension.extra/${TARGET_BRANCH} 
git tag -f extension.extra.${VERSION}
git push extension.extra extension.extra.${VERSION}:${VERSION}

# Tag GuzzleHttp Bridge 
git checkout refs/remotes/bridge.guzzle_http/${TARGET_BRANCH} 
git tag -f bridge.guzzle_http.${VERSION}
git push bridge.guzzle_http bridge.guzzle_http.${VERSION}:${VERSION}

# Tag Origin
git checkout refs/remotes/bridge.doctrine_orm/${TARGET_BRANCH} 
git tag -f bridge.doctrine_orm.${VERSION}
git push bridge.doctrine_orm bridge.doctrine_orm.${VERSION}:${VERSION}

# Tag Origin
git checkout refs/remotes/adapter.doctrine/${TARGET_BRANCH} 
git tag -f adapter.doctrine.${VERSION}
git push adapter.doctrine adapter.doctrine.${VERSION}:${VERSION}

